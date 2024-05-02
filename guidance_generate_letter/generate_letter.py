from fpdf import FPDF
import datetime
import sys
import pymysql

report_ID = sys.argv[1]
guardian_name = sys.argv[2]
address = sys.argv[3]
# guardian_name = 'Loyola Omega'
# address = '074, Inaon, Pulilan, Bulacan'
# report_ID = '1Y4agP07'
current_date = datetime.datetime.now()
formatted_date = current_date.strftime("%B %d, %Y")

# Database connection parameters
host = "localhost"  # MySQL server hostname
user = "root"  # MySQL username
password = ""  # MySQL password
database = "ticketing_system"  # Name of your MySQL database

# Establish a database connection
connection = pymysql.connect(host=host, user=user, password=password, database=database)

# Create a cursor object to interact with the database
cursor = connection.cursor()

insert_query_TYPE = "SELECT rr.report_ID, rr.date_time, rr.student_name, rr.offense_type, rr.further_details, rm.remarks FROM report_records rr INNER JOIN remarks rm ON rr.report_ID = rm.report_ID WHERE rr.report_ID = '" + str(report_ID) + "'"
decision_action = cursor.execute(insert_query_TYPE)
result = cursor.fetchone()

date_time = result[1]
student_name = result[2]
offense_made = result[3]
further_details = result[4]
remarks = result[5]


# Close the cursor and connection when done
cursor.close()
connection.close()

class PDF(FPDF):
    def header(self):
        self.image('../images/school_logo.png', 30, 8, 25)
        self.set_font('helvetica', 'B', 16)
        self.cell(195, 20, 'Dulong Malabon Integrated School', border=False, align='C')
        self.set_font('helvetica', '', 12)
        self.cell(-198, 32, 'Dulong Malabon, Pulilan, Bulacan, Philippines', border=False, align='C')
        self.ln(25)
        # Draw a line after the header
        self.line(10, self.y, 200, self.y)

pdf = PDF('P', 'mm', 'A4')

pdf.add_page()
pdf.set_font('times', '', 12)
pdf.cell(0, 20, str(formatted_date), border=False, ln=True)
pdf.cell(0, 5, str(guardian_name), border=False, ln=True)
pdf.cell(0, 5, str(address), border=False, ln=True)

pdf.cell(0, 20, 'Good Day,', border=False, ln=True)

main_message = "We're reaching out to discuss a recent incident involving your child, "+ student_name +", and a breach of school policy. Your child is proven guilty and we've addressed the matter in line with our disciplinary procedures, but we wanted to emphasize the importance of your involvement in reinforcing positive behavior at home. Please return the appointment slip since we would like to discuss this issue with you."
pdf.multi_cell(0, 5, main_message, border=False)

pdf.cell(0, 20, 'Sincerely Yours, ', border=False, ln=True)

pdf.set_font('times', 'B', 13)
pdf.cell(0, 5, 'Ms. Jobelyn E. Banag', border=False, ln=True)
pdf.set_font('times', '', 12)
pdf.cell(0, 5, 'Guidance Councilor', border=False, ln=True)

pdf.ln(20)
pdf._set_dash(1, 1)
pdf.line(10, pdf.y, 200, pdf.y)
pdf.ln(0) 
pdf.cell(0, 5, '(Cut this side, it will serve as your appointment slip.)', border=False, ln=True)

pdf.set_font('times', 'B', 24)
pdf.cell(0, 30, 'APPOINTMENT SLIP', border=False, align='C', ln=True)

# Set font for label "Name:"
pdf.set_font('times', 'B', 16)
pdf.cell(18, 20, 'Name: ', border=False)

# Set font for student name
pdf.set_font('times', '', 16)
pdf.cell(0, 20, student_name, border=False, ln=True)
pdf.ln(10) 
pdf._set_dash(0, 0)
# Draw a line after the header
pdf.line(10, pdf.y, 100, pdf.y)
pdf.set_font('times', '', 14)
pdf.cell(0, 20, "Adviser's Signature Over Printed Name", border=False)

pdf.ln(30) 
# Draw a line after the header
pdf.line(10, pdf.y, 100, pdf.y)
pdf.set_font('times', '', 14)
pdf.cell(0, 20, "Guardian's Signature Over Printed Name", border=False)
         
pdf.output('./letters/'+str(report_ID)+'.pdf')

print(report_ID)