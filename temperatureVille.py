# coding: UTF-8
"""
Script: pythonProject/temperatureVille
Création: rdouet, le 15/01/2021
"""


# Imports
import requests
import mysql.connector
import time


# Fonctions
def get_temperature(ville):
    url = "http://api.openweathermap.org/data/2.5/weather?q=" + ville + ",fr&units=metric&lang=fr&appid=0a73790ec47f53b9e1f2e33088a0f7d0"
    return float(requests.get(url).json()['main']['temp'])

def get_pression(ville):
    url = "http://api.openweathermap.org/data/2.5/weather?q=" + ville + ",fr&units=metric&lang=fr&appid=0a73790ec47f53b9e1f2e33088a0f7d0"
    return float(requests.get(url).json()['main']['pressure'])

def set_bdd(ville, temperature, pression):
    cnx = mysql.connector.connect(user='root', password='', host='127.0.0.1', database='bdd_temperaturevilles')
    cursor = cnx.cursor()
    update_val = ("UPDATE temperaturevilles SET temperature = (%s),pression = (%s) WHERE ville = (%s)")
    data = (temperature, pression, ville)
    cursor.execute(update_val, data)
    cnx.commit()
    cursor.close()
    cnx.close()


# Programme principal
def main():
    List_ville=["lyon", "grenoble", "dommartin"]

    while True:
        for element in List_ville:
            set_bdd(element, get_temperature(element), get_pression(element))
            print(f'{element} à été mis à jour.')
            time.sleep(2)
        print("\n")
        time.sleep(300)
    #print(get_temperature("lyon"))
    #print(get_temperature("grenoble"))
    #print(get_temperature("dommartin"))


if __name__ == '__main__':
    main()
# Fin
