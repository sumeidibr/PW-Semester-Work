<!--Script pintar-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const linhasTabela = document.querySelectorAll('table tbody tr');
        linhasTabela.forEach(function(linha) {
            linha.addEventListener('click', function() {
                // Remove a classe de todas as outras linhas
                linhasTabela.forEach(function(outraLinha) {
                    outraLinha.classList.remove('selected-row');
                });
                // Adiciona a classe à linha clicada
                this.classList.add('selected-row');
            });
        });
    });
</script>
</body>
</html>