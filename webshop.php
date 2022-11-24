<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
<script>const html = document.querySelector('html');function switchTheme(theme) {html.dataset.theme = `theme-${theme}`;localStorage.setItem('theme', `theme-${theme}`);}</script>
<main>

</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>