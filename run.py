import requests as req
import base64

class tri:
  def __init__(self, num_input):
    self.num_input = num_input

  def login(self):
    my_secret = 'https://bimaplus.tri.co.id/api/v1/login/otp-request'
    dat = {
      "imei": "Android 93488a982824b403",
      "language": 1,
      "msisdn": self.num_input
    }
    nom = req.post(url=my_secret, json=dat).json()
    return nom['message']

  def getOtp(self, otp):
    my_secret ="https://bimaplus.tri.co.id/api/v1/login/login-with-otp"
    dat = {
      "deviceManufactur": "Samsung",
      "deviceModel": "SMG991B",
      "deviceOs": "Android",
      "imei": "Android 93488a982824b403",
      "msisdn": self.num_input,
      "otp": otp
    }
    log = req.post(url=my_secret, json=dat).json()
    logi = log['status']
    if logi == True:
      self.secret = log['secretKey']
      self.plan = log['callPlan']
      self.nomor = log['msisdn']
      return logi
    else:
      return logi

  def profile(self):
    my_secret = "https://bimaplus.tri.co.id/api/v1/homescreen/profile"
    dat = {
      "callPlan": self.plan,
      "deviceManufactur": "Samsung",
      "deviceModel": "SMG991B",
      "deviceOs": "Android",
      "imei": "Android 93488a982824b403",
      "language": 0,
      "msisdn": self.nomor,
      "page": 1,
      "secretKey": self.secret,
      "subscriberType": "Prepaid"
    }
    log = req.post(url=my_secret, json=dat).json()
    self.pulsa = log['creditBalance'],
    self.aktif = log['activeUntil']
    self.sisakuota = log['sumOfInternet']
    self.poin = log['stotalPoin']
    return self.pulsa, self.aktif, self.sisakuota, self.poin

  def check(self, prodi):
    my_secret = "https://my.tri.co.id/apibima/product/product-detail"
    dat = {
      "imei": "WebSelfcare",
      "language": "0",
      "callPlan": "",
      "msisdn": "",
      "secretKey": "",
      "subscriberType": "",
      "productId": prodi
    }
    log = req.post(url=my_secret, json=dat).json()['product']

    return log

  def buy(self, prodi):
    my_secret = "https://bimaplus.tri.co.id/api/v1/purchase/purchase-product"
    dat = {
      "addonMenuCategory": "",
      "addonMenuSubCategory": "",
      "balance": "",
      "callPlan": self.plan,
      "deviceManufactur": "Samsung",
      "deviceModel": "SMG991B",
      "deviceOs": "Android",
      "imei": "Android 93488a982824b403",
      "language": 0,
      "menuCategory": "3",
      "menuCategoryName": "TriProduct",
      "menuIdSource": "",
      "menuSubCategory": "",
      "menuSubCategoryName": "",
      "msisdn": self.nomor,
      "paymentMethod": "00",
      "productAddOnId": "",
      "productId": prodi,
      "secretKey": self.secret,
      "servicePlan": "Default",
      "sms": "true",
      "subscriberType": "Prepaid",
      "totalProductPrice": "",
      "utm": "",
      "utmCampaign": "",
      "utmContent": "",
      "utmMedium": "",
      "utmSource": "",
      "utmTerm": "",
      "vendorId": "11"
    }
    log = req.post(url=my_secret, json=dat).json()

    return log

def base_pw():
    base64_message = 'YW1nZWVreg=='
    base64_bytes = base64_message.encode('ascii')
    message_bytes = base64.b64decode(base64_bytes)
    message = message_bytes.decode('ascii')

    return message



list_harga = "[1] Welcome Reward 5GB ==> Rp 1\n[2] (NEW) 10GB 30 Hari ==> Rp 15000\n[3] (NEW) 15GB 30 Hari ==> Rp 20000\n[4] 25GB 25rb (Diskon) ==> Rp 25000\n[5] 25GB 24 Jam 20 Hari ==> Rp 25000\n[6] (NEW) 25GB 20 Hari ==> Rp 25000\n[7] (NEW) 25GB 20 Hari ==> Rp 25000\n[8] 25GB 24 Jam 30 Hari ==> Rp 29000\n[9] (NEW) 25GB 30 Hari ==> Rp 29000\n[10] (NEW) 55GB 30 Hari ==> Rp 50000\n[11] (NEW) 65GB 30 Hari ==> Rp 60000\n[12] (NEW) 75GB 30 Hari ==> Rp 75000\n[13] (NEW) 90GB 30 Hari ==> Rp 90000\n[14] (NEW) 100GB 30 Hari ==> Rp 90000\n[15] (NEW) 22GB 30 Hari ==> Rp 30000\n"


inp = input('Masukan Password License : ')
if inp == base_pw():

    beg = True
    while beg:
        banner = """
        +-+-+-+ +-+-+-+-+-+-+ +-+-+-+
        |B|O|T| |T|e|m|b|a|k| |T|r|i|
        +-+-+-+ +-+-+-+-+-+-+ +-+-+-+
        """
        print(banner)
        no = input('\nMasukan Nomor  : ')
        bot = tri(no)
        login = bot.login()
        print(login)
        ot = input('\nOtp : ')
        getop = bot.getOtp(ot)

        if getop == True:
            #sec = getop[1]
            #plan = getop[2]
            #num = getop[3]
            prof = bot.profile()
            print(
            f'Pulsa : {prof[0][0].replace(" ",".")}\nAktif : {prof[1]}\nSisa Kuota : {prof[2]}\nPoin : {prof[3]}\n\n'
            )
            print(list_harga)
            pilihan = input('Pilih : ')
            prod = ""
            if pilihan == "1":
                prod = "25669"
            elif pilihan == "2":
                prod = "25245"
            elif pilihan == "3":
                prod = "25459"
            elif pilihan == "4":
                prod = "22648"
            elif pilihan == "5":
                prod = "23160"
            elif pilihan == "6":
                prod = "25254"
            elif pilihan == "7":
                prod = "25264"
            elif pilihan == "8":
                prod = "23164"
            elif pilihan == "9":
                prod = "25267"
            elif pilihan == "10":
                prod = "25469"
            elif pilihan == "11":
                prod = "25690"
            elif pilihan == "12":
                prod = "25247"
            elif pilihan == "13":
                prod = "25476"
            elif pilihan == "14":
                prod = "25693"
            elif pilihan == "15":
                prod = "28650"
            else:
                print('Masukin yang bener!')

            cek = bot.check(prod)
            name = cek['productName']
            price = cek['productPrice']
            desc = cek['productDescription']
            print(f"Nama Paket\t: {name}\nHarga\t: {price}\nDeskripsi\t: {desc}")
            konf = input('Konfirmasi y/n : ').lower()
            if konf == 'y':
                beli = bot.buy(prod)

            if beli['status'] == True:
                print('Pembelian Sukses!')
                bag = False
            else:
                print('pembelian gagal')
        else:
            print('invalid')
            bag = False

else:
    print('Password tidak cocok!')
