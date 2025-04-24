document.addEventListener('DOMContentLoaded', function() {
    const voltarBtn = document.getElementById('botao-voltar');
    
    if (voltarBtn) {
        voltarBtn.addEventListener('click', function() {
            setTimeout(function() {
                window.location.href = "main.html";
            }, 500);
        });
    }
    
});