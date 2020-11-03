window.livewire.on('getin-ok', msg => {
    Snackbar.show({
        text: msg.toUpperCase(),
        pos: 'top-center',
        showAction: false,
        actionTextColor: '#fff',
        backgroundColor: '#8dbf42'
    })
})
window.livewire.on('msg-ok', msg => {
    Snackbar.show({
        text: msg.toUpperCase(),
        pos: 'top-center',
        showAction: false,
        actionTextColor: '#fff',
        backgroundColor: '#2196f3'
    })
})
window.livewire.on('getout-ok', msg => {
    Snackbar.show({
        text: msg.toUpperCase(),
        pos: 'top-center',
        showAction: false,
        actionTextColor: '#fff',
        backgroundColor: '#2196f3'
    })
})
window.livewire.on('msg-ops', msg => {
    Snackbar.show({
        text: msg.toUpperCase(),
        pos: 'top-center',
        showAction: false,
        actionTextColor: '#fff',
        backgroundColor: '#e2a03f'
    })
})
window.livewire.on('getout-error', msg => {
    Snackbar.show({
        text: msg.toUpperCase(),
        pos: 'top-center',
        showAction: false,
        actionTextColor: '#fff',
        backgroundColor: '#e7515a'
    })
})