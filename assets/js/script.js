// function formataCPF(cpf) {
//     const elementoAlvo = cpf
//     const cpfAtual = cpf.value   
    
//     let cpfAtualizado;
    
//     cpfAtualizado = cpfAtual.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, 
//      function( regex, argumento1, argumento2, argumento3, argumento4 ) {
//             return argumento1 + '.' + argumento2 + '.' + argumento3 + '-' + argumento4;
//     })  
//     elementoAlvo.value = cpfAtualizado; 
//     }    

    function gerarBiometria(field, el) {
        hash = Math.random().toString(36).replace(/[^a-z]+/g, '');
        $(field).val(hash);
        $(el).addClass("d-none");
        $(".btn-remove-biometria").removeClass("d-none");
    }

    function removeBiometria(field, el) {
        $(field).val("");
        $(el).addClass("d-none");
        $(".btn-add-biometria").removeClass("d-none");
    }
    
    function calculaFerias(el) {
        var el = el;
        var inicio_ferias = el.value.split("-");

        var total_ferias_ano = 30;
        var total_ferias_utilizado = $("#ferias-dias-utilizados").val();
        var total_ferias_restante = Number(total_ferias_ano) - Number(total_ferias_utilizado);

        var limite_ferias = Number(inicio_ferias[2]) + Number(total_ferias_restante);

        $("#ferias-final").attr("max", "2020-06-" + limite_ferias);



    }
    