function setTheme (themeType) {
    // $.ajax({
    //     type: "POST",url: "/actions/theme/changeTheme.php",data: {theme: themeType.split('-')[1]},cache: false,
    //     success: function(data) {
    //         if (themeType.split('-')[1] === 'auto') {const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
    //             if (darkThemeMq.matches) {document.querySelector('html').dataset.theme = 'theme-light';
    //             } else {document.querySelector('html').dataset.theme = 'theme-dark';}
    //         } else {document.querySelector('html').dataset.theme = 'theme-' + themeType.split('-')[1];}
    //     },error: function () {console.log('Cannot change theem. Try again.');}
    // });
    console.log(themeType);
}