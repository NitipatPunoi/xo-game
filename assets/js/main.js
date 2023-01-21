function screenChange(screen) {
    let fadeTime = 500
    $('section').fadeOut(fadeTime)
    setTimeout(function() {
        location.assign(screen)
    }, fadeTime)
}

$('button[data-screen]').on('click', function() {
    let screen = $(this).data('screen')
    screenChange(screen)
})