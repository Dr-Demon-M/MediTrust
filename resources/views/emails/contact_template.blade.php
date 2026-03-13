<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* الأساسيات لضمان عمل الإيميل على الموبايل */
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f7ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f4f7ff;
            padding-bottom: 40px;
        }

        .main-table {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-spacing: 0;
            color: #444444;
            border-radius: 20px;
            overflow: hidden;
            margin-top: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .header {
            background-color: #1f3bb3;
            padding: 40px;
            text-align: center;
            color: #ffffff;
        }

        .content {
            padding: 40px;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #888888;
        }

        .info-badge {
            background-color: #f0f3ff;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            border-left: 4px solid #1f3bb3;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #1f3bb3;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            margin-top: 25px;
        }

        .label {
            font-weight: bold;
            color: #1f3bb3;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 1px;
        }

        .value {
            font-size: 16px;
            margin-bottom: 15px;
            color: #2c3e50;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <table class="main-table">
            <tr>
                <td class="header">
                    <h1 style="margin: 0; font-size: 24px; letter-spacing: 1px;">MediTrust Clinic</h1>
                    <p style="margin: 5px 0 0; opacity: 0.8; font-size: 14px;">New Patient Inquiry Received</p>
                </td>
            </tr>

            <tr>
                <td class="content">
                    <h2 style="color: #2c3e50; margin-top: 0;">Hello Admin,</h2>
                    <p>You have received a new contact message through the clinic's website. Here are the data of the
                        inquiry:</p>

                    <div class="info-badge">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <span class="label">Patient Name</span>
                                    <div class="value">{{ $data['name'] }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="label">Phone Number</span>
                                    <div class="value">{{ $data['phone'] }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="label">Subject</span>
                                    <div class="value">{{ $data['subject'] }}</div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div style="margin-top: 30px;">
                        <span class="label">Message Content</span>
                        <p
                            style="background: #fafafa; padding: 15px; border-radius: 8px; border: 1px solid #eee; color: #555;">
                            {{ $data['message'] }}
                        </p>
                    </div>

                    <center>
                        <a href="{{ url('/admin/dashboard/contact-messages') }}" class="button">View in Dashboard</a>
                    </center>
                </td>
            </tr>

            <tr>
                <td class="footer">
                    <p>&copy; {{ date('Y') }} MediTrust Clinic. All rights reserved.</p>
                    <p>15 Ahmed Orabi St, Dokki, Giza, Egypt</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
