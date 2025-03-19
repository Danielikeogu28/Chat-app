const selectedContact = $('meta[name="selected_contact"]');
const authId = $('meta[name="auth_id"]').attr("content");
const baseUrl = $('meta[name="base_url"]').attr("content");
const inbox = $(".messages ul");

function toggleLoader() {
    $(".loader").toggleClass("d-none");
}

function messageTemplet(text, className) {
  return `<li class="${className}"><img src="${baseUrl}/image/avatar.jpg" alt="" /><p>${text}</p></li>`;
}

function fetchMessage() {
    let contactId = selectedContact.attr("content");
    $.ajax({
        method: "GET",
        url: baseUrl + "/fetch-messages",
        data: {
            contact_id: contactId,
        },
        beforeSend: function () {
            toggleLoader();
        },
        success: function (data) {
            setContactInfo(data.contact);
            //append messages 
            inbox.empty();
            data.messages.forEach(value => {
              if(value.from_id == contactId) {
                inbox.append(messageTemplet(value.message, 'sent'));
              }else{
                inbox.append(messageTemplet(value.message, 'replies'));
              }
                
            });
            authScroll();
        },
        error: function (xhr, status, error) {},
        complete: function () {
            toggleLoader();
        },
    });
}

function sendMessage() {
    let messageBox = $(".message-box");
    let contactId = selectedContact.attr("content");
    let formData = $(".message-form").serialize();
    $.ajax({
        method: "POST",
        url: baseUrl + "/send-message",
        data: formData + "&contact_id=" + contactId,

        beforeSend: function () {
            let message = messageBox.val();
            inbox.append(messageTemplet(message, 'replies'));
            messageBox.val('')
            authScroll();
        },
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.log(xhr);
        },
    });
}

function setContactInfo(contact) {
    $(".contact-name").text(contact.name);
}

function authScroll(){
    $('.messages').stop().animate({
        scrollTop: $('.messages')[0].scrollHeight
    });
}

$(document).ready(function () {
    // Select contact when clicked
    $(".contact").on("click", function () {
        let contactId = $(this).data("id");
        selectedContact.attr("content", contactId); 
        console.log(selectedContact.attr("content")); 
        //blank wrap
        $('.blank-wrap').addClass('d-none');
        //fetch messages
        fetchMessage();
    });

    $(".message-form").on("submit", function (e) {
        e.preventDefault();
        sendMessage();
    });
});

window.Echo.private('messages.' + authId)
        .listen('SendMessageEvent', (e) => {
            if(e.from_id == selectedContact.attr("content")){
                inbox.append(messageTemplet(e.text, 'sent'));
                authScroll();
            }
});

window.Echo.join('online')
    .here(user => {
        user.forEach(user => {
           let element = $(`.contact[data-id="${user.id}"]`);
           if(element.length > 0){
                element.find('.contact-status').removeClass('offline');
                element.find('.contact-status').addClass('online')
           } else{
                element.find('.contact-status').addClass('online');
                element.find('.contact-status').removeClass('ofline');
           }
        });
        
    })
    .joining(user =>{
        let element = $(`.contact[data-id="${user.id}"]`);
        element.find('.contact-status').removeClass('offline');
        element.find('.contact-status').addClass('online');
    })
    .leaving(user => {
        let element = $(`.contact[data-id="${user.id}"]`);
        element.find('.contact-status').removeClass('online');
        element.find('.contact-status').addClass('offline')
    });