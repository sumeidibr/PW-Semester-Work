

    // Obtém a referência para o botão de abrir modal
    var openModalBtn = document.getElementById('openModalBtn');

    // Obtém a referência para a modal
    var modal = document.getElementById('myModal');

    // Obtém a referência para o botão de fechar a modal
    var closeBtn = document.getElementsByClassName('close')[0];

    // Define o evento de clique no botão de abrir modal
    openModalBtn.addEventListener('click', function() {
        modal.style.display = 'block'; // Exibe a modal ao clicar no botão
    });

    // Define o evento de clique no botão de fechar a modal
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none'; // Oculta a modal ao clicar no botão de fechar
    });

    // Define o evento para fechar a modal quando clicar fora dela
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });