document.addEventListener('DOMContentLoaded', function() {
    const SENHA_CORRETA = "21.01.1978"; 
    const senhaInput = document.getElementById('senha');
    const submitBtn = document.getElementById('submit-btn');
    const mensagemDiv = document.getElementById('mensagem');
    
    submitBtn.addEventListener('click', function() {
        const senhaDigitada = senhaInput.value;
        
        mensagemDiv.textContent = '';
        mensagemDiv.style.color = ''; 
        
        
        if (senhaDigitada === '') {
            mensagemDiv.textContent = 'Por favor, insira uma senha';
            mensagemDiv.style.color = 'red';
            return;
        }
        
        
        if (senhaDigitada === SENHA_CORRETA) {
            mensagemDiv.textContent = 'Senha correta! Acessando sistema...';
            mensagemDiv.style.color = 'green';
            
            setTimeout(function() {
                window.location.href = "main.html";
            }, 1000);
            
        } else {
            mensagemDiv.textContent = 'Senha incorreta. Tente novamente.';
            mensagemDiv.style.color = 'red';
            senhaInput.value = '';
            senhaInput.focus(); 
        }
    });
    
    
    senhaInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            submitBtn.click(); 
        }
    });
});