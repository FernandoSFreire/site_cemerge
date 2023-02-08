$('#form-contato').submit(function(){
    var name = $('#name');
    var email = $('#email');
    var message = $('#message');
    var erro = $('.alert');
    var campo = $('#campo-erro');

    // removendo o elemento da tela ao submeter ao formulário
    erro.addClass('hidden');
    $('.is-invalid').removeClass('is-invalid');

    //valida o campo nome
    if (name.val() == '') {
        erro.removeClass('hidden');
        campo.html('Nome');//nome do campo que nao foi preenchido!
        name.focus();
        name.addClass('is-invalid');
        return false;
    }

    //valida o campo email
    if (email.val() == '') {
        erro.removeClass('hidden');
        campo.html('E-mail');//nome do campo que nao foi preenchido!
        email.focus();
        email.addClass('is-invalid');
        return false;
    }

    //valida o campo mensagem
    if (message.val() == '') {
        erro.removeClass('hidden');
        campo.html('Mensagem');//nome do campo que nao foi preenchido!
        message.focus();
        message.addClass('is-invalid');
        return false;
    }

    return true;
});