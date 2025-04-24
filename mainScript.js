document.addEventListener('DOMContentLoaded', function() {
    const sairBtn = document.getElementById('botao-sair');
    
    if (sairBtn) {
        sairBtn.addEventListener('click', function() {
            setTimeout(function() {
                window.location.href = "login.html";
            }, 500);
        });
    }
 
    const clientesBtn = document.getElementById('botao-clientes');
    
    if (clientesBtn) {
        clientesBtn.addEventListener('click', function() {
            setTimeout(function() {
                window.location.href = "clientes.html";
             }, 500);
        });
    }

    const alterarBtn = document.getElementById('botao-alterar');
    
    if (alterarBtn) {
        alterarBtn.addEventListener('click', function() {
            setTimeout(function() {
                window.location.href = "alterar.html";
             }, 500);
        });
    }

    

});
