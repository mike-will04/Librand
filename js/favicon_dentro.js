function updateFavicon() {
    const favicon = document.getElementById("favicon");
    const isDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches;

    // Atualiza o href do favicon de acordo com o tema
    favicon.href = isDarkMode ? "../../img/Maozinha_branca.png" : "../../img/Maozinha_azul.png";
}

// Atualiza o favicon quando o tema muda
window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", updateFavicon);

// Atualiza o favicon ao carregar a página
updateFavicon();
