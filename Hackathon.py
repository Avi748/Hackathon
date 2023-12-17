import psycopg2
import smtplib
import os
from dotenv import load_dotenv

# Load variables from the .env file into the environment
load_dotenv()

def send_mail(email):

    HOST = "smtp.gmail.com"
    PORT = 587

    FROM_EMAIL = email
    TO_EMAIL = email
    PASSWORD = os.getenv("PASSWORD")

    MESSAGE = """Subject: Congratulation!!
    the National Farmers Organization granted you a scholarship,

    Dear Student.

    
    You've been working with us for the past 2 weeks and we want to congratulate you.
    It was our pleasure to work with you and see that your hard work has at last paid off. Make good use of your scholarship. 
    This scholarship opens the entryways to your splendid future.  

    Thanks,
    (National Farmers Organization) """

    smtp = smtplib.SMTP(HOST, PORT)

    status_code, response = smtp.ehlo()
    print(f"[*] Echoing the server: {status_code} {response}")

    status_code, response = smtp.starttls()
    print(f"[*] Starting TLS connection: {status_code} {response}")

    status_code, response = smtp.login(FROM_EMAIL, PASSWORD)
    print(f"[*] Logging in: {status_code} {response}")

    smtp.sendmail(FROM_EMAIL, TO_EMAIL, MESSAGE)
    smtp.quit()

class Scholarship:
    def __init__(self) -> None:
        self.conn = self.connect_to_db()

    def connect_to_db(self):
        return psycopg2.connect(
            dbname='Hackathon',
            user='postgres',
            password='656565',
            host='localhost',
            port='5432'
        )
    
    def get_email(self, id):
        cur = self.conn.cursor()
        cur.execute("SELECT student_email FROM students WHERE student_id = %s",[id])
        rows = cur.fetchone()
        for row in rows:
            return row
        cur.close()

    def view_all_volunteers(self):
        cur = self.conn.cursor()
        cur.execute("SELECT * FROM volunteers")
        rows = cur.fetchall()
        for row in rows:
            print(row)
        cur.close()


    def view_all_students(self):
        cur = self.conn.cursor()
        cur.execute("SELECT * FROM students")
        rows = cur.fetchall()
        for row in rows:
            print(row)
        cur.close()

    def add_student(self, id):
        cur = self.conn.cursor()
        cur.execute("INSERT INTO students (student_name, student_last_name, student_email, student_phone) SELECT first_name, last_name, email, phone_number FROM volunteers WHERE id = (%s)", (id))
        self.conn.commit()
        cur.close()

    def update_student(self, value, id):
        cur = self.conn.cursor()
        cur.execute("UPDATE students SET student_work_days = %s WHERE student_id = %s",(value, id))
        self.conn.commit()
        if value >= 10:
            send_mail(self.get_email(id))
        cur.close()

    def display(self):
        print("************************************************************************************************************************************")
        print("Volunteers Management System \n")
        print("1. View all volunteers \n")
        print("2. View all students \n")
        print("3. Add a student \n")
        print("4. Update a student \n")
        print("0. Exit \n")
        print("************************************************************************************************************************************")

    def user_input(self, value):
        return input(value)
    
    def end_program(self):
        self.conn.close()

    def start_program(self):
        while True:
            self.display()
            choice = self.user_input("Enter your choice: \n")

            if choice == "1":
                print("All volunteers: \n")
                self.view_all_volunteers()

            elif choice == "2":
                print("All students: \n")
                self.view_all_students()

            elif choice == "3":
                print("Add a student: \n")
                volunteer_id = self.user_input("Enter a volunteer ID to add to the student list: ")
                self.add_student(volunteer_id)
                print("Student added successfully. \n")

            elif choice == "4":
                print("update a student:")
                student_id = self.user_input("Enter a student ID you want to update: ")
                student_day = int(self.user_input("Enter how many days the student work: "))
                self.update_student(student_day, student_id)
                print("Student has been updated successfully. \n")

            elif choice == "0":
                break
            else:
                print("Invalid choice. Please try again.")

if __name__ == "__main__":
    main = Scholarship()
    main.start_program()
    main.end_program()