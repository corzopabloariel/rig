enviar = t => {
    let url = t.action;
    let method = t.method;
    let idForm = t.id;
    let formElement = document.getElementById(idForm);
    let formData = new FormData(formElement);
    grecaptcha.ready(function() {
        $( ".form-control" ).prop( "readonly" , true );
        Toast.fire({
            icon: 'warning',
            title: 'Espere, enviando'
        });
        grecaptcha.execute(publicKey, {action: 'contact'}).then( function( token ) {
            formData.append( "token", token );
            axios({
                method: method,
                url: url,
                data: formData,
                responseType: 'json',
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then((res) => {
                $( ".form-control" ).prop( "readonly" , false );
                if( parseInt( res.data.estado ) ) {
                    $( ".form-control" ).val( "" );
                    Toast.fire({
                        icon: 'success',
                        title: res.data.mssg
                    });
                } else
                    Toast.fire({
                        icon: 'error',
                        title: res.data.mssg
                    });
            })
            .catch((err) => {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrió un error'
                });
            })
            .then(() => {});
        });
    });
};