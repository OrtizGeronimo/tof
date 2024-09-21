
const mp = new MercadoPago("APP_USR-492a1ba6-e95d-4545-a0e7-0f43717fcfef");

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
      onSubmit: event => {
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

        //document.getElementById("MPHiddenInputPaymentMethod").value = paymentMethodId;
        
        //para enviar el email que se seteo en el form previamente 
        let emailToSend = document.getElementById("email").value;

        fetch("./controller/process_payment.php", {
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
    //comienzo form original
    const form = document.querySelector("#form-checkout");
    /*form.addEventListener("submit",()=>{
      if(!passwordValid()){
        document.querySelector("#newPassword").style.backgroundColor = "pink";
        document.querySelector("#renewPassword").style.backgroundColor = "pink";
        alertSwal('error','Las contraseñas ingresadas no son iguales');
      }
    })

    document.querySelector("#form-checkout__submit1").addEventListener('click',() => {

      
    });*/
    console.log("COMENZANDO FORM ORIGINAL");

    console.log("form",form);

    let isCamposLlenos = true;

      for (let i = 0; i < form.elements.length; i++) {
        console.log(form.elements[i].value);

        let element = form.elements[i];
        if (element.value === '') {
          console.log("campo vacio", element);
          isCamposLlenos = false;
          break;
        }
      }
      if(!isCamposLlenos){
        alertSwal('error',"Complete los campos del formulario");
      }else if(!passwordValid()){
        document.querySelector("#newPassword").style.backgroundColor = "pink";
        document.querySelector("#renewPassword").style.backgroundColor = "pink";
        alertSwal('error','Las contraseñas ingresadas no son iguales');
      }else{
        let dataForm = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "./controller/registerUser.php",
          data: dataForm,
          processData: false,
          contentType: false,
          success: function(result) {
            if(result === '1'){
              alertSwal('success',result);
              location.replace('./admin/newService.php');
            }else{
              alertSwal('error',result);
            }
          },
          error: function(xhr, status, error) {
            alertSwal('error',`${status} : ${error}`);
            // Realiza acciones adicionales en caso de error
          }
        });
      }
      //fin form original
      
    },
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
  

