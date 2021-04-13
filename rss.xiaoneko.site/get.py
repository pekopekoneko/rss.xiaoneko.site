# -*- coding: utf-8 -*-
"""
Created on Tue Jan 26 13:25:07 2021

@author: Sinon
"""

account='20206179'
password='Swear0931GTX'
length=30

from selenium import webdriver
import time
import pandas as pd
from selenium.webdriver.chrome.options import Options

chrome_options =Options()
chrome_options.add_argument('--headless')

df = pd.read_excel("student.xlsx")



def my_click(xpath):
    driver.find_element_by_xpath(xpath).click()
    return
def my_fill(xpath,fill):
    driver.find_element_by_xpath(xpath).send_keys(fill)
    return
def my_find(xpath):
    return(driver.find_element_by_xpath(xpath))
def my_text(xpath):
    return(driver.find_element_by_xpath(xpath).text)


path_of_chromedriver = r"chromedriver.exe"#驱动器路径
driver = webdriver.Chrome(path_of_chromedriver)#打开浏览器
driver = webdriver.Chrome(options=chrome_options)
url="https://m.ruc.edu.cn/uc/wap/login?redirect=https%3A%2F%2Fm.ruc.edu.cn%2Fsite%2FapplicationSquare%2Findex%3Fsid%3D2"
driver.get(url)
my_fill('//*[@id="app"]/div[2]/div[1]/input',account)
my_fill('//*[@id="app"]/div[2]/div[2]/input',password)
my_click('//*[@id="app"]/div[3]')
time.sleep(8)

my_click('/html/body/div[1]/div[1]/div/section/div/div[3]/div[2]/ul/li/span')
time.sleep(8)
my_click('//*[@id="mescroll"]/div[5]/div[1]/div[1]/p[3]')
js='document.getElementById("mescroll").scrollTop=200000'
for i in range(1,length):
    time.sleep(0.3)
    driver.execute_script(js)

time.sleep(5)

result=pd.DataFrame(columns=('name','student_num',"school","class"))
for i in range(1,10000):
    try:
        xpath='//*[@id="mescroll"]/div[5]/div[2]/div['+str(i)+']/p[5]'
        if(my_text(xpath)=="今日未上报"): 
            xpath1='//*[@id="mescroll"]/div[5]/div[2]/div['+str(i)+']/p[1]'
            xpath2='//*[@id="mescroll"]/div[5]/div[2]/div['+str(i)+']/p[2]'
            name=my_text(xpath1)
            student_num=my_text(xpath2)
            now=df.loc[df['name'] == name]
            school=now.iat[0,2]
            this_class=now.iat[0,3]
            new=pd.DataFrame({"name":[name],"student_num":[student_num],"school":[school],"class":[this_class]})
            result=result.append(new)
    except:
        break
result.to_excel('未上报明细.xls')



