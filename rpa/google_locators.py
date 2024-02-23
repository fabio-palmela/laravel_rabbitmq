from selenium import webdriver
from selenium.webdriver.common.by import By
import time

class GoogleSearch():
    def __init__(self):
        # chrome_options = webdriver.ChromeOptions()
        # chrome_options.add_argument('--headless')  # Opcional: execute em modo headless
        # chrome_options.add_argument('--no-sandbox')  # Opcional: desative o sandbox se necessário
        # self.driver = webdriver.Chrome(executable_path='C:/Users/fabio.oliveira/chromedriver.exe', options=chrome_options)
        self.driver = webdriver.Chrome()
        self.driver.maximize_window()
        self.driver.get("https://www.google.com/")
    
    def search(self):
        search_input = self.driver.find_element(By.NAME, "q")
        search_input.send_keys("rpa rabbitmq")
        search_input.submit()
        time.sleep(5)
    
    def tearDown(self):
        self.driver.quit()

if __name__ == '__main__':
    unittest.main()
