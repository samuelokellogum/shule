/**
 * Created by CHARLES on 15/09/2017.
 */
$(document).ready();

function Notify(title, text, type){
    new PNotify({
        title: title,
        text: text,
        type: type,
        styling: 'bootstrap3',
        delay: 3000
    });
}


function sValidateForm(form, retfun){
    var retVal = false;
    var valFront = function () {
        if (true === form.parsley().isValid()) {
            $('.bs-callout-info').removeClass('hidden');
            $('.bs-callout-warning').addClass('hidden');
            retVal = true;
        } else {
            $('.bs-callout-info').addClass('hidden');
            $('.bs-callout-warning').removeClass('hidden');
            retVal = false;
        }
    }
    $.listen('parsley:field:validate', function() {
        valFront();
    });
    form.parsley().validate();
    valFront();
    retfun(retVal);
}

function showWaitDialog(message) {
    waitingDialog.show(message,{dialogSize: 'sm', progressType: 'success'});
}

function hideWaitDialog(){
    waitingDialog.hide();
}

function confirmDiaglog(title,confirm){
    $.confirm({
        title: 'Confirm!',
        content: title,
        buttons: {
            confirm:{
                text: 'Ok',
                action: function () {
                confirm()
                }
            },
            cancel: function () {

            }
        }
    });
}




