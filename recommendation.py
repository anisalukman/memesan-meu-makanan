import mysql.connector

def recommend_food():
    # Koneksi ke MySQL
    conn = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="restaurant_db"
    )

    cursor = conn.cursor()
    cursor.execute("SELECT name FROM menu WHERE type = 'food' LIMIT 1")
    result = cursor.fetchone()
    print("Rekomendasi makanan hari ini: " + result[0])

if __name__ == "__main__":
    recommend_food()
