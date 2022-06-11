<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <!-- import #zmmtg-root css -->
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.0/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.0/css/react-select.css"/>
</head>
<body>
<script src="https://source.zoom.us/1.9.0/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/1.9.0/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/1.9.0/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/1.9.0/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/1.9.0/lib/vendor/lodash.min.js"></script>
<script src="https://source.zoom.us/zoom-meeting-1.9.0.min.js"></script>
<script>
    var routeList = "";
    var meetingNumber = "";
    var passWord = "";
    var userName = "";
    var api_key = "";
    var signature = "";
    var invite = "";

    console.log('checkSystemRequirements');
    console.log(JSON.stringify(ZoomMtg.checkSystemRequirements()));
    ZoomMtg.preLoadWasm();
    ZoomMtg.prepareJssdk();

    testTool = window.testTool;

    ZoomMtg.init({
        leaveUrl: routeList,
        isSupportAV: true,
        success: function () {
            ZoomMtg.i18n.load("vi-VN");
            ZoomMtg.i18n.reload("vi-VN");
            ZoomMtg.join(
                {
                    meetingNumber: meetingNumber,
                    userName: userName,
                    signature: signature,
                    apiKey: api_key,
                    passWord: passWord,
                    success: function(res){
                        $('#nav-tool').hide();
                        console.log('join meeting success');

                        // meeting set to record by default
                        ZoomMtg.record({
                            record: true
                        });

                        ZoomMtg.showInviteFunction({
                            show: invite
                        });

                        // or use a json file load language resource
                        // $.i18n.load("/js/zoom-lang/vi-VN.json", "vi-VN");

                    },
                    error: function(res) {
                        console.log(res);
                    }
                }
            );
        },
        error: function(res) {
            console.log(res);
        }
    });
    //event

    ZoomMtg.inMeetingServiceListener('onUserJoin', function (data) {
        console.log('onUserJoin');
        console.log(data);
    });

    ZoomMtg.inMeetingServiceListener('onUserLeave', function (data) {
        console.log('onUserLeave');
        console.log(data);
    });

    ZoomMtg.inMeetingServiceListener('onUserIsInWaitingRoom', function (data) {
        console.log('onUserIsInWaitingRoom');
        console.log(data);
    });

    ZoomMtg.inMeetingServiceListener('onMeetingStatus', function (data) {
        // {status: 1(connecting), 2(connected), 3(disconnected), 4(reconnecting)}
        console.log('onMeetingStatus');
        console.log(data);
    });
</script>
</body>
</html>
