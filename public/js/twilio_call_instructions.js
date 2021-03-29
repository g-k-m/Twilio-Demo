// Store some selectors for elements we'll reuse
var callStatus = $(".container__call__main__status");
var hangUpButton = $(".container__call__main__hangup");
var callButton = $(".container__call__main__call");

/* Helper function to update the call status bar */
function updateCallStatus(status) {
    callStatus.text(status);
}

/* Setup csrf token else 419 unknown status */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// The access token
var tokenData;

$(function () {
    $.post("/token", function (data) {
        tokenData = data;
    }).fail(function (err) {
        console.log('Could not get a token from server!');
        console.log(err);        
    });
});

function call() {
    updateCallStatus("Calling " + document.getElementById("toNumber").value + "...");

    var params = {
        To: document.getElementById("toNumber").value
    };

    if (typeof device !== 'undefined') {
        var outgoingConnection = device.connect(params);

        outgoingConnection.on("ringing", function () {
            updateCallStatus("Ringing");
        });
    } else {
        console.log("Tried to call, no device initiated");
    }

    // Bind button to hangup call
    document.getElementById("container__call__main__hangup").addEventListener("click", disconnectCall);
}

function disconnectCall() {
    //log("Hanging up...");

    if (typeof device !== 'undefined') {
        device.disconnectAll();
        console.log('Disconnected');
    } else {
        console.log('Tried to disconnect, no device initiated');
    }
}


// Bind button to make call, https://support.twilio.com/hc/en-us/articles/360003699893-Chrome-66-AudioContext-and-Twilio-JavaScript-Client-1-4
document.getElementById("container__call__main__call").onclick = function () {
    if (typeof device !== 'undefined') {
        console.log("Device already detected, going to call()")

        call();
    } else {
        console.log('Device not detected, making new device');

        // Setup Twilio.Device
        device = new Twilio.Device(tokenData);

        device.on("ready", function (device) {
            console.log("Twilio.Device Ready!");
            updateCallStatus("Ready");

            call();
        });

        device.on("error", function (error) {
            //log("Twilio.Device Error: " + error.message);
            updateCallStatus("ERROR: " + error.message);
        });

        device.on("connect", function (connection) {
            console.log('Successfully established call!');

            // Enable the hang up button and disable the call buttons
            hangUpButton.prop("disabled", false);
            hangUpButton.visibility = 'visible';
            callButton.prop("disabled", true);
            callButton.visibility = 'hidden';

            // If phoneNumber is part of the connection, this is a call from a
            // support agent to a customer's phone
            if ("phoneNumber" in connection.message) {
                updateCallStatus("In call with " + connection.message.phoneNumber);
            }
        });

        device.on("disconnect", function (connection) {
            console.log("Call ended");

            hangUpButton.prop("disabled", true);
            hangUpButton.visibility = 'hidden';
            callButton.prop("disabled", false);
            callButton.visibility = 'visible';

            updateCallStatus("Ready");

            document.getElementById("container__call__main__hangup").removeEventListener("click", disconnectCall);
        });

        /* if (navigator.mediaDevices) {
            navigator.mediaDevices.getUserMedia({ audio: true })
                .then(function (stream) {
                    /* use the stream
                })
                .catch(function (err) {
                    console.log("Couldn't get user media, error: " + err);
                });
        } else {
            console.log("navigator.mediaDevices is not defined");
        }
    
         Initiate audio context
        var audioCtx = new AudioContext();
    
        audioCtx.resume().then(() => {
            console.log('Playback resumed successfully');
        }); */
    }
};

