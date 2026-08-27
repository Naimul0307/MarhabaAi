<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Request</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, Helvetica, sans-serif;
            color: #222222;
        }

        .email-wrapper {
            width: 100%;
            padding: 35px 15px;
            box-sizing: border-box;
        }

        .email-container {
            width: 100%;
            max-width: 620px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e5e5e5;
        }

        .header {
            background-color: #000000;
            padding: 32px 25px;
            text-align: center;
            border-bottom: 4px solid #c9a227;
        }

        .header h1 {
            margin: 0;
            color: #ffffff;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .header-line {
            width: 55px;
            height: 2px;
            background-color: #c9a227;
            margin: 15px auto 0;
        }

        .content {
            padding: 35px;
        }

        .content h2 {
            margin: 0 0 12px;
            color: #000000;
            font-size: 20px;
            font-weight: 600;
        }

        .content-intro {
            margin: 0 0 25px;
            color: #666666;
            font-size: 14px;
            line-height: 1.7;
        }

        .details {
            border: 1px solid #dddddd;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 25px;
        }

        .detail-row {
            padding: 15px 17px;
            border-bottom: 1px solid #e5e5e5;
            font-size: 14px;
            line-height: 1.5;
        }

        .detail-row:last-child {
            border-bottom: 0;
        }

        .label {
            display: inline-block;
            width: 80px;
            color: #b08d1c;
            font-weight: 700;
        }

        .value {
            color: #333333;
        }

        .message-title {
            margin: 0 0 10px;
            color: #b08d1c;
            font-size: 15px;
            font-weight: 700;
        }

        .message-box {
            background-color: #f8f8f8;
            border-left: 3px solid #c9a227;
            border-radius: 4px;
            padding: 17px;
            color: #444444;
            font-size: 14px;
            line-height: 1.7;
            white-space: pre-line;
        }

        .button-wrapper {
            text-align: center;
            padding-top: 28px;
        }

        .button {
            display: inline-block;
            padding: 13px 28px;
            background-color: #000000;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid #c9a227;
        }

        .button:hover {
            background-color: #c9a227;
            color: #000000 !important;
        }

        .footer {
            background-color: #000000;
            border-top: 2px solid #c9a227;
            padding: 20px;
            text-align: center;
            color: #bbbbbb;
            font-size: 12px;
            line-height: 1.6;
        }

        .footer strong {
            color: #c9a227;
            font-weight: 600;
        }

        @media only screen and (max-width: 600px) {
            .email-wrapper {
                padding: 15px 10px;
            }

            .content {
                padding: 25px 20px;
            }

            .header {
                padding: 27px 20px;
            }

            .header h1 {
                font-size: 21px;
            }

            .label {
                width: 70px;
            }
        }
    </style>
</head>

<body>

<div class="email-wrapper">

    <div class="email-container">

        <div class="header">
            <h1>New Contact Request</h1>
            <div class="header-line"></div>
        </div>

        <div class="content">

            <h2>Hello Team,</h2>

            <p class="content-intro">
                You have received a new message from your website contact form.
                Please find the customer details below.
            </p>

            <div class="details">

                <div class="detail-row">
                    <span class="label">Name</span>
                    <span class="value">{{ $mailData['name'] }}</span>
                </div>

                <div class="detail-row">
                    <span class="label">Email</span>
                    <span class="value">{{ $mailData['email'] }}</span>
                </div>

                <div class="detail-row">
                    <span class="label">Phone</span>
                    <span class="value">{{ $mailData['phone'] }}</span>
                </div>

            </div>

            <p class="message-title">
                Message
            </p>

            <div class="message-box">
                {{ $mailData['message'] }}
            </div>

            <div class="button-wrapper">
                <a
                    href="mailto:{{ $mailData['email'] }}"
                    class="button"
                >
                    Reply to Sender
                </a>
            </div>

        </div>

        <div class="footer">
            <strong>Marhaba AI</strong> &copy; {{ date('Y') }}.
            All rights reserved.
        </div>

    </div>

</div>

</body>
</html>
