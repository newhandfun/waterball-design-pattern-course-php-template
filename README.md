# 水球軟體學院-設計模式課程專用php專案基底

為了降低建立專案的心智負擔，我建立此專案讓我或有緣人自行pull下來快速寫作業。
畢竟我們不是來建專案，而是來學設計模式的。

# 使用說明

1. clone下來
2. 重新設定remote origin
3. 盡情揮灑創意

# 小工具

php本身環境不好裝，所以筆者用container執行程式跟測試。
本專案裡也有自己有用到的小工具，各位可以自己斟酌著用。

## Helper

很多作業會需要用到的一些方便的函式。若有遺漏，歡迎送PR!
```
src/helper.php
```

## 透過docker執行程式

* main.php
```
bash run.bash
```

* 其它檔案
```
bash run.bash {檔案名稱}
```

## 透過docker執行測試

* 執行tests資料夾下所有測試
```
bash test.bash
```

* 想在該專案執行phpunit
```
bash test.bash {phpunit相關的參數}
```

## 非同步IO案例 (libuv)

在C4M1H1時會遇到非同步的需求，此時可以參考`async.php`的寫法。你可以執行以下指令看看你的環境能不能順利執行。
```
bash run.bash async.php
```


# 注意事項

以下幾點應該都是可以改進的，若知道如何修正，請不吝於發PR!

* 筆者開發環境是windows，雖然已經盡可能用docker，但bash中的語法還是可能會不支援或需要針對環境不同而改寫。
* 使用libuv時，不能用pipe將測試檔案輸入程式中達成測試。要執行程式，並手動複製並貼上至CMD。