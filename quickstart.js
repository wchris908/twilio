// import $ from "jquery";
// const { Device } = require('twilio-client');

var callStatus = $("#call-status");
var answerButton = $(".answer-button");
var callSupportButton = $(".call-support-button");
var hangUpButton = $(".hangup-button");
var callCustomerButtons = $(".call-customer-button");

var device = null;

function updateCallStatus(status) {
    callStatus.attr('placeholder', status);
}

$(document).ready(function() {    
    setupClient();
});

function setupHandlers(device) {
    device.on('ready', function (_device) {
        updateCallStatus("Ready");
    });


    device.on('error', function (error) {
        updateCallStatus("ERROR: " + error.message);
    });

    device.on('connect', function (connection) {
        hangUpButton.prop("disabled", false);
        callCustomerButtons.prop("disabled", true);
        callSupportButton.prop("disabled", true);
        answerButton.prop("disabled", true);

        if ("phoneNumber" in connection.message) {
            updateCallStatus("In call with " + connection.message.phoneNumber);
        } else {
            updateCallStatus("In call with support");
        }
    });

    device.on('disconnect', function(connection) {
        hangUpButton.prop("disabled", true);
        callCustomerButtons.prop("disabled", false);
        callSupportButton.prop("disabled", false);

        updateCallStatus("Ready");
    });

    device.on('incoming', function(connection) {
        updateCallStatus("Incoming support call");
        
        connection.accept(function() {
            updateCallStatus("In call with customer");
        });

        answerButton.click(function() {
            connection.accept();
        });
        answerButton.prop("disabled", false);
    });
};

function setupClient() {
    $.post("token.php", {
        forPage: window.location.pathname,
        // _token: $('meta[name="csrf-token"]').attr('content')
    }).done(function (data) {
        console.log(data);
        device = new Twilio.Device();
        device.setup(data);
        setupHandlers(device);
    }).fail(function () {
        updateCallStatus("Could not get a token from server!");
    });

};

window.callCustomer = function(phoneNumber) {
    updateCallStatus("Calling " + phoneNumber + "...");
    
    var params = {"phoneNumber": phoneNumber};
    device.connect(params);
};

window.callSupport = function() {
    updateCallStatus("Calling support...");

    device.connect();
};

window.hangUp = function() {
    device.disconnectAll();
};
