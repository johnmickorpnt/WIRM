<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Success!</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fbc9e418a7.js" crossorigin="anonymous"></script>

    <style>
        body {
            margin: 0px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100vw;
            height: 100vh;
            min-height: 675px;
            background-color: #F4F5FF;
        }

        p {
            width: 100%;
            left: 0px;
            font-size: 16px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            letter-spacing: 0px;
            text-align: center;
            vertical-align: top;
            max-width: 550px;
            color: #727586;
            margin: 0px;
        }

        h1 {
            font-family: 'DM Sans', sans-serif;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0px;
            text-align: center;
            margin: 8px;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .ic-launch {
            margin-left: 10.5px;
            width: 21px !important;
            height: 20px !important;
        }

        .link-container {
            margin-top: 32px;
            margin-bottom: 32px;
        }

        .link {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            font-family: 'DM Sans', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 14px;
            color: #673DE6;
            margin-top: 8px;
            text-decoration: none;
        }

        .main-image {
            width: 100%;
            max-width: 650px;
            max-height: 406px;
            height: auto;
        }

        .navigation {
            width: 100%;
            height: 72px;
            display: flex;
            margin: 0;
            padding: 0;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            background-color: #36344D;
        }

        @media screen and (max-width: 580px) and (min-width: 0px) {

            h1,
            p,
            .link-container {
                width: 80%;
            }
        }

        @media screen and (min-width: 650px) and (min-height: 0px) and (max-height: 750px) {
            .link-container {
                margin-top: 12px;
            }

            h1 {
                margin-top: 0px;
                margin-bottom: 0px;
            }
        }
    </style>

</head>

<body style="background:rgba(0,0,0,0.7); height:100vh; display:flex; align-items:center;justify-content:center">
    <div style="background-color: white; width:50%; display:flex; flex-direction:column; align-items:center; padding:1.5rem; border-radius:10px; gap:0.5rem; position:relative">
        <div style="position:absolute; top:-1.5rem; background:rgba(100, 200, 100, 1);
        padding:1rem; border-radius:50%">
            <i class="fa-solid fa-check fa-beat fa-2xl"></i>
        </div>
        <h1>Reservation Booked Successfully!</h1>
        <p>
            Please proceed to payment to confirm your reservation with us! <br>Go to My Account and find your reserved room and click pay.
        </p>
        <a href="my-account" class="default-btn">Go to Reservations</a>
    </div>

</body>

</html>