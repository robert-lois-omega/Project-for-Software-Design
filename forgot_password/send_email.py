# Replace these values with your actual MySQL database credentials
import smtplib
import ssl
from email.message import EmailMessage
import sys

# Define email sender and receiver
email_receiver = sys.argv[1]
new_password = sys.argv[2]
username_add = sys.argv[3]


def send_email(username_add, email_receiver, new_password):

    email_sender = 'printhubapmteam@gmail.com'
    email_password = 'tyjd jfnr sufx axjk'

    # Set the subject and body of the email
    subject = 'Password Reset Code'
    body = "Your password reset code for " + username_add + " was: " + new_password

    em = EmailMessage()
    em['From'] = email_sender
    em['To'] = email_receiver
    em['Subject'] = subject
    em.set_content(body)

    # Add SSL (layer of security)
    context = ssl.create_default_context()

    # Log in and send the email
    with smtplib.SMTP_SSL('smtp.gmail.com', 465, context=context) as smtp:
        smtp.login(email_sender, email_password)
        smtp.sendmail(email_sender, email_receiver, em.as_string())
    print("Notif. sent to: " + str(email_receiver))

send_email(username_add, email_receiver, new_password)