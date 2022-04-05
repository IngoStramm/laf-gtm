// Tidio Chat

const lgTidioChat = () => {
    if (lg_object.lg_tidio !== 'on') {
        return false
    }
    console.log('carregou: ', lg_object);
    const handleBtnClick = (e) => {
        e.preventDefault()
        btnToTrack.removeEventListener('click', handleBtnClick)
        console.log('clickou btnToTrack');
    }

    // cria o botão e adiciona ao body
    const btnId = lg_object.lg_tidio_btn_id ? lg_object.lg_tidio_btn_id : 'lg-tidio-btn'
    const btnToTrack = document.createElement('a')
    btnToTrack.id = btnId
    btnToTrack.addEventListener('click', handleBtnClick)
    document.body.appendChild(btnToTrack)

    // verifica se o tidio chat já carregou
    const checkTidioChat = setInterval(() => {
        const tidioChat = document.getElementById('tidio-chat-iframe')
        // console.log(tidioChat);
        if (typeof (tidioChat) !== undefined && tidioChat !== null) {
            clearInterval(checkTidioChat)
            console.log('achou iframe')
            const btnChat = tidioChat.contentWindow.document.getElementById('button-body')
            const checkBtnChat = setInterval(() => {
                if (typeof (btnChat) !== undefined || btnChat !== null) {
                    console.log('achou btn')
                    clearInterval(checkBtnChat)
                    btnChat.addEventListener('click', () => {
                        chatStarted = true
                        btnToTrack.click()
                    })
                }
            }, 500)
        }
    }, 500)
}

lgTidioChat()

// document.addEventListener('DOMContentLoaded', function () { });
