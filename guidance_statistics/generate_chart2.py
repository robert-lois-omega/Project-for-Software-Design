import pymysql
import matplotlib.pyplot as plt
from datetime import datetime
from collections import Counter
# importing the style package 
from matplotlib import style 


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
sql_query = "SELECT offense_type FROM report_records"

# Execute the query
cursor.execute(sql_query)

# Fetch all the rows and store them in a list of tuples
rows = cursor.fetchall()

# Close cursor and connection
cursor.close()
conn.close()

data = []

# Sample frequency values
offense_type = []
frequency = []

# Display the retrieved data
for row in rows:
    data.append(str(row[0]))
    
element_counts = Counter(data)

for element, count in element_counts.items():
    frequency.append(count)
    offense_type.append(element)
    
# Create a line graph
plt.barh(offense_type, frequency)


# Add labels and title
plt.xlabel('Frequency', fontsize=12, color='blue')
plt.ylabel('Offense', fontsize=12, color='blue')
plt.title('OVERALL OFFENSE FREQUENCY', fontsize=18, fontweight='bold', color='blue', y=1.05)

# using the style for the plot 
plt.style.use('seaborn') 

# Format x-axis as dates
plt.gcf().autofmt_xdate()

# Set margins incrementing by 1 only on the y-axis
plt.margins(x=1, y=0)
plt.grid("x")

# Adjust font size of tick labels on both axes
plt.xticks(fontsize=10)
plt.yticks(fontsize=10)

# Add legend
# plt.legend()

# plt.figure(figsize=(20, 6))

# Save the chart as an image
plt.savefig('../images/overall_offense_frequency.png', bbox_inches='tight')
