
import json
import cv2
import os
from datetime import datetime, date
import numpy as np

class JsonToDatetime(json.JSONEncoder):
    def default(self, obj):
        if isinstance(obj, datetime):
            return obj.strftime('%Y-%m-%d %H:%M:%S')
        elif isinstance(obj, date):
            return obj.strftime('%Y-%m-%d')
        else:
            return json.JSONEncoder.default(self, obj)


class SameImage:

    def __init__(self, img1, img2):
        if os.path.exists(img1) and os.path.exists(img2):
            size = (256, 256)
            im1 = cv2.imread(img1)
            im2 = cv2.imread(img2)
            self.image1 = cv2.resize(im1, size)
            self.image2 = cv2.resize(im2, size)
        else:
            print("File Not Found")

    def oneColor(self):
        return self.oneColorAct(self.image1, self.image2)

    def oneColorAct(self, image1, image2):
        hist1 = cv2.calcHist([image1], [0], None, [256], [0.0, 255.0])
        hist2 = cv2.calcHist([image2], [0], None, [256], [0.0, 255.0])
        degree = 0
        for i in range(len(hist1)):
            if hist1[i] != hist2[i]:
                degree = degree + (1 - abs(hist1[i] - hist2[i]) / max(hist1[i], hist2[i]))
            else:
                degree = degree + 1
        degree = degree / len(hist1)
        return degree

    def threeColor(self):
        image1 = cv2.split(self.image1)
        image2 = cv2.split(self.image2)
        result = 0
        for im1, im2 in zip(image1, image2):
            result += self.oneColorAct(im1, im2)
        result = result / 3
        return result

    def aHash(self, img):
        img = cv2.resize(img, (8, 8))
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        s = 0
        hash_str = ''
        for i in range(8):
            for j in range(8):
                s = s+gray[i, j]
        avg = s / 64
        for i in range(8):
            for j in range(8):
                if gray[i, j] > avg:
                    hash_str = hash_str+'1'
                else:
                    hash_str = hash_str+'0'
        return hash_str

    def dHash(self, img):
        img = cv2.resize(img, (9, 8))
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        hash_str = ''
        for i in range(8):
            for j in range(8):
                if gray[i, j] > gray[i, j+1]:
                    hash_str = hash_str+'1'
                else:
                    hash_str = hash_str+'0'
        return hash_str

    def pHash(self, img):
        img = cv2.resize(img, (32, 32))
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        dct = cv2.dct(np.float32(gray))
        dct_roi = dct[0:8, 0:8]
        hash = []
        avreage = np.mean(dct_roi)
        for i in range(dct_roi.shape[0]):
            for j in range(dct_roi.shape[1]):
                if dct_roi[i, j] > avreage:
                    hash.append(1)
                else:
                    hash.append(0)
        return hash

    def cmpHash(self, hash1, hash2):
        n = 0
        if len(hash1) != len(hash2):
            return -1
        for i in range(len(hash1)):
            if hash1[i] != hash2[i]:
                n = n + 1
        return n

    def hash1(self):
        h1 = self.aHash(self.image1)
        h2 = self.aHash(self.image2)
        result = self.cmpHash(h1, h2)
        return result

    def hash2(self):
        h1 = self.dHash(self.image1)
        h2 = self.dHash(self.image2)
        result = self.cmpHash(h1, h2)
        return result

    def hash3(self):
        h1 = self.pHash(self.image1)
        h2 = self.pHash(self.image2)
        result = self.cmpHash(h1, h2)
        return result

    def color(self):
        one = self.oneColor()
        three = self.threeColor()
        result = (one + three) / 2
        return result[0]

    def hash(self):
        h1 = self.hash1()
        h2 = self.hash2()
        h3 = self.hash3()
        result = (h1 + h2 + h3) / 3
        return result

    def show(self):
        cv2.imshow("image1", self.image1)
        cv2.imshow("image2", self.image2)
        cv2.waitKey(0)

    def canPass(self):
        if self.color() > 0.5 and self.hash() < 17:
            return True
        else:
            return False
