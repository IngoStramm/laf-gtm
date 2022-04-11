let lgGtmOptions = []

// Tidio Chat

const lgTidioChat = () => {
    if (lg_object.lg_tidio !== 'on') {
        return false
    }
    /*jshint -W069 */
    lgGtmOptions.push({
        id: 'tidio',
        on: lg_object.lg_tidio,
        btnId: lg_object.lg_tidio_btn_id ? lg_object.lg_tidio_btn_id : 'lg-tidio-btn'
    })
    /*jshint -W069 */
}

// RD WhatsApp

const lgRdWhats = () => {
    if (lg_object.lg_rd_whats !== 'on') {
        return false
    }
    /*jshint -W069 */
    lgGtmOptions.push({
        id: 'rd-whats',
        on: lg_object.lg_rd_whats,
        btnId: lg_object.lg_rd_whats_btn_id ? lg_object.lg_rd_whats_btn_id : 'lg-rd-whats-btn'
    })
    /*jshint -W069 */
}

const startGtmTracker = () => {
    lgTidioChat()
    lgRdWhats()

    // cria o botão "fantasma" e o adiciona ao body
    for (const item of lgGtmOptions) {
        const btnId = item.btnId
        const btnToTrack = document.createElement('a')
        btnToTrack.id = btnId
        btnToTrack.addEventListener('click', (e) => {
            e.preventDefault()
            console.log('clickou: ' + btnId);
        })
        document.body.appendChild(btnToTrack)

        if (item.id === 'tidio') {
            // verifica se o tidio chat já carregou
            const checkTidioChat = setInterval(() => {
                const tidioChat = document.getElementById('tidio-chat-iframe')
                // console.log(tidioChat);
                if (typeof (tidioChat) !== undefined && tidioChat !== null) {
                    clearInterval(checkTidioChat)
                    // console.log('achou iframe')
                    const btnChat = tidioChat.contentWindow.document.getElementById('button-body')
                    const checkBtnChat = setInterval(() => {
                        if (typeof (btnChat) !== undefined || btnChat !== null) {
                            // console.log('achou btn')
                            clearInterval(checkBtnChat)
                            btnChat.addEventListener('click', () => {
                                btnToTrack.click()
                            })
                        }
                    }, 500)
                }
            }, 500)
        }

        if (item.id === 'rd-whats') {

            // incia o loop
            const checkRdWhats = setInterval(() => {

                // Os código abaixo estão usando as classes para encontrar os elementos,
                // pos os IDs não são fixos, eles mudam de site para site
                // por isso estão sendo usados vários "forEach"

                // Botão para abrir a janela do chat do RD Station WhatsApp
                const rdstationPopupJsFloatingButtons = document.getElementsByClassName('rdstation-popup-js-floating-button')

                // Loop busca pelo botão usando a classe
                Array.prototype.forEach.call(rdstationPopupJsFloatingButtons, rdstationPopupJsFloatingButton => {
                    // console.log(rdstationPopupJsFloatingButton)
                    // salva os elementos em variáveis
                    const rdstationPopupJsFloatingButtonsParent = rdstationPopupJsFloatingButton.parentNode
                    const bricksFormInputs = rdstationPopupJsFloatingButtonsParent.getElementsByClassName('bricks-form__input')
                    const rdstationPopupJsSubmitButtons = rdstationPopupJsFloatingButtonsParent.getElementsByClassName('rdstation-popup-js-submit-button')
                    const rdWhatsForm = rdstationPopupJsFloatingButtonsParent.getElementsByTagName('form')

                    // verifica se os elementos existem
                    if (bricksFormInputs.length > 0 && rdstationPopupJsSubmitButtons.length > 0 && rdWhatsForm.length > 0) {

                        // interrompe o loop
                        clearInterval(checkRdWhats)

                        // Adiciona um evento no click do botão
                        rdstationPopupJsSubmitButtons[0].addEventListener('click', (e) => {

                            let validateFields = true;

                            // Verifica se os campos foram validados
                            Array.prototype.forEach.call(bricksFormInputs, (bricksFormInput, i) => {
                                if (bricksFormInput.value.length === 0 || bricksFormInput.parentNode.classList.contains('has-danger')) {
                                    validateFields = false;
                                }
                                if (i === 2 && bricksFormInput.value.length <= 4 || bricksFormInput.parentNode.classList.contains('has-danger')) {
                                    validateFields = false;
                                }
                            });

                            // Se os campos foram validados, dispara o botão "fantasma"
                            if (validateFields === true) {
                                btnToTrack.click()
                                /*jshint -W087 */
                                debugger
                                /*jshint -W087 */
                            }

                        });

                    }

                });

            }, 500)
        }
    }

}


startGtmTracker()

// document.addEventListener('DOMContentLoaded', function () { });
