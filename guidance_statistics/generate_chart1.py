import pymysql
import matplotlib.pyplot as plt
from datetime import datetime
from collections import Counter
# importing the style package 
from matplotlib import style
import matplotlib.pyplot as pylab


# Database connection parameters
host = 'localhost'
user = 'root'
password = ''
database = 'ticketing_system'

# Connect to the database
conn = pymysql.connect(
    host=host,
    user=user,
    password=password,
    database=database
)

# Create a cursor object to execute SQL queries
cursor = conn.cursor()

# SQL query to retrieve data from the reports table
sql_query = "SELECT date_time FROM report_records"

# Execute the query
cursor.execute(sql_query)

# Fetch all the rows and store them in a list of tuples
rows = cursor.fetchall()

# Close cursor and connection
cursor.close()
conn.close()

data = []

# Sample frequency values
date_strings = []
frequency = []

# Display the retrieved data
for row in rows:
    data.append(str(row[0])[0:10])
    
data.sort()
element_counts = Counter(data)

for element, count in element_counts.items():
    frequency.append(count)
    date_strings.append(element)

# Create a line graph
plt.plot(date_strings, frequency, marker='o')
plt.ylim(0)

# Add labels and title
plt.xlabel('Date', fontsize=10, color='blue')
plt.ylabel('Occurence', fontsize=10, color='blue', x=0.5)
plt.title('OFFENSE DAILY REPORT', fontsize=16, fontweight='bold', color='blue', y=1.05)

# using the style for the plot 
plt.style.use('classic') 

# Format x-axis as dates
plt.gcf().autofmt_xdate()
# Set margins incrementing by 1 only on the y-axis
plt.margins(x=0, y=1)
plt.grid("x")

# Adjust font size of tick labels on both axes
plt.xticks(fontsize=10)
plt.yticks(fontsize=10)

# plt.figure(figsize=(20, 6))

# Save the chart as an image
plt.savefig('../images/offense_daily_report.png', bbox_inches='tight')