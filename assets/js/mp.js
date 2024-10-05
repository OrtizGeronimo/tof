


const cardForm = mp.cardForm({
    amount: "100.5",
    iframe: true,
    form: {
      id: "form-checkout",
      cardNumber: {
        id: "form-checkout__cardNumber",
        placeholder: "Numero de tarjeta",
      },
      cardExpirationMonth: {
          id: "form-checkout__cardExpirationMonth",
          placeholder: "MM",
      },
      cardExpirationYear: {
          id: "form-checkout__cardExpirationYear",
          placeholder: "YY",
      },
      securityCode: {
        id: "form-checkout__securityCode",
        placeholder: "Código de seguridad",
      },
      cardholderName: {
        id: "form-checkout__cardholderName",
        placeholder: "Titular de la tarjeta",
      },
      issuer: {
        id: "form-checkout__issuer",
        placeholder: "Banco emisor",
      },
      installments: {
        id: "form-checkout__installments",
        placeholder: "Cuotas",
      },        
      identificationType: {
        id: "form-checkout__identificationType",
        placeholder: "Tipo de documento",
      },
      identificationNumber: {
        id: "form-checkout__identificationNumber",
        placeholder: "Número del documento",
      },
      cardholderEmail: {
        id: "form-checkout__cardholderEmail",
        placeholder: "E-mail",
      },
    },
    callbacks: {
      onFormMounted: error => {
        if (error) return console.warn("Form Mounted handling error: ", error);
        console.log("Form mounted");
      },
      onSubmit: async event => {
        event.preventDefault();
    
        const {
            payment_method_id,
            issuerId: issuer_id,
            cardholderEmail: email,
            amount,
            token,
            installments,
            identificationNumber,
            identificationType,
        } = cardForm.getCardFormData();
    
        let emailToSend = document.getElementById("email").value;
        const form = document.querySelector("#form-checkout");
    
        let isCamposLlenos = true;
    
        for (let i = 0; i < form.elements.length; i++) {
          let element = form.elements[i];
    
          // Ignore hidden inputs, buttons, and submit inputs
          if (element.type === 'hidden' || element.type === 'button' || element.type === 'submit') {
              continue;
          }
      
          // Check if the element's id starts with "MP" (Mercado Pago inputs)
          if (element.id.startsWith("MP")) {
              continue;
          }
      
          // Check if the element is empty
          if (element.value === '') {
              console.log("Elemento vacío:", element);
              isCamposLlenos = false;
              break;
          }
        }
    
        if (!isCamposLlenos) {
            alertSwal('error', "Complete los campos del formulario");
        } else if (!passwordValid()) {
            document.querySelector("#newPassword").style.backgroundColor = "pink";
            document.querySelector("#renewPassword").style.backgroundColor = "pink";
            alertSwal('error', 'Las contraseñas ingresadas no son iguales');
        } else {

              Swal.fire({
                title: 'Procesando pago...',
                text: 'Por favor, espera mientras se procesa tu pago.',
                icon: 'info',
                allowOutsideClick: false,  // Prevent closing the alert by clicking outside
                showConfirmButton: false,  // Hide the confirm button
                didOpen: () => {
                    Swal.showLoading();  // Show a loading spinner
                }
            });
            // Form is valid, proceed with user creation and payment process
            try {
                let dataForm = new FormData(form);
    
                // 1. First, create the user
                const userCreationResult = await $.ajax({
                    type: "POST",
                    url: "./controller/registerUser.php",
                    data: dataForm,
                    processData: false,
                    contentType: false
                });
    
                if (userCreationResult.status !== 'success') {
                    // User creation failed
                    alertSwal('error', userCreationResult.message);
                    console.log("error", userCreationResult.user);
                    return;
                }
    
                // 2. If user is created successfully, proceed with payment
                const paymentResponse = await fetch("./controller/process_payment.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        token,
                        issuer_id,
                        payment_method_id,
                        transaction_amount: Number(amount),
                        installments: Number(installments),
                        description: "Descripción del producto",
                        payer: {
                            email: emailToSend,
                            identification: {
                                type: identificationType,
                                number: identificationNumber,
                            },
                        },
                    }),
                });
    
                const paymentResult = await paymentResponse.json();
    
                console.log(paymentResult);

                id = paymentResult.id;
                idUsuario = userCreationResult.idUsuario;

                //se crea la suscripcion

                const suscriptionResponse = await fetch("./controller/suscription.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        id: id,
                        idUsuario: idUsuario,
                    }),
                });

                

                Swal.close();  // Cerramos spinner

                if (suscriptionResponse.status !== 'success') {
                  alertSwal('error', "Error al crear la suscripción");
                  return;
              }

                // Response de payment
                if (paymentResult.status === 'approved' || paymentResult.status === 'authorized') {
                  Swal.fire({
                    icon: 'success',
                    title: 'Bienvenido!',
                    text: 'Te suscribiste correctamente.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.replace('./admin/newService.php');
                });
                } else if (paymentResult.status === 'in_process') {
                  Swal.fire({
                    icon: 'info',
                    title: 'El pago está siendo procesado',
                    text: 'Te notificaremos por correo cuando se realice.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.replace('./admin/newService.php');
                });
                } else if (paymentResult.status === 'rejected' || paymentResult.status === 'cancelled') {
                    // Payment failed, delete the user (rollback)
                    await $.ajax({
                        type: "POST",
                        url: "./controller/deleteUser.php", // Endpoint to delete the user
                        data: { email: emailToSend }
                    });
                    alertSwal('error', 'El pago falló, por favor, corroborá los datos e intentalo nuevamente');
                }
    
            } catch (error) {
              Swal.close();
              alertSwal('error', `Error: ${error.message}`);
            }
        }
    }
    ,
      onFetching: (resource) => {
        console.log("Fetching resource: ", resource);

        // Animate progress bar
        const progressBar = document.querySelector(".progress-bar");
        progressBar.removeAttribute("value");

        return () => {
          progressBar.setAttribute("value", "0");
        };
      }
    },
  });
  

