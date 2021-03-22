#!/usr/bin/env python2
# -*- coding: utf-8 -*-

"""
Programme de bruitage et débruitage d'une image avec calcul du SNR
Par Mathis SERRIERES MANIECKI et David BALLARD
"""

#--- Bibliothèques ---
import skimage.io as io
import numpy as np
import math as math
import matplotlib.pyplot as plt
import random as rdm


#--- Importation de l'image ---
image = io.imread("lena.png")
matrice_image = 1.0*np.array(image)


#--- Bruitage Poivre et Sel ---
def Bruitage_PoivreSel(image,bruitage):                  
    #Copie de la matrice originale
    bruitage = 100-bruitage
    image_bruitee = np.copy(image)                   	
    
    #Parcourt de la matrice
    for i in range(image_bruitee.shape[0]):
        for j in range(image_bruitee.shape[1]):     
            #On génère un nombre aléatoire entre 0 et 10 pour sélectionner le pixel à bruiter
            taux_bruitage = rdm.randint(0, bruitage)
            #Si le nombre aléatoire = 10
            if taux_bruitage == bruitage:
                #On génère un nombre aléatoire entre 0 et 1 pour la sélection de la couleur
                couleur_pixel = rdm.randint(0, 1)
                #Si le nombre aléatoire = 0
                if couleur_pixel == 0:
                    #On change le pixel en noir
                    image_bruitee[i,j] = 0
                else:
                    #On change le pixel en blanc
                    image_bruitee[i,j] = 255
    
    #On retourne la matrice modifiée
    return image_bruitee


#--- Bruitage Additif ---
def Bruitage_Additif(image,bruitage):
    #Copie de la matrice originale
    image_bruitee = np.copy(image)
    
    #Parcourt de la matrice
    for j in range(image_bruitee.shape[0]):
        for i in range(image_bruitee.shape[1]):
            #Création de la valeur à affecter à chaque pixel
            t = int(math.floor(image_bruitee[j][i] + rdm.gauss(0,bruitage)))        #Additions de la valeur du pixel avec la variable de gauss (mu,sigma)
            #Affecter la valeur en positif si elle est négative 
            if (t) < 0:
                image_bruitee[j][i] = -t
            #Affecter 255 au pixel si il dépasse 255
            if (t) > 255:                           	 
                image_bruitee[j][i] = 255
            #Sinon, affecter la valeur au pixel désigné
            else:                                    	 
                image_bruitee[j][i] = t
    
    #On retourne la matrice modifiée
    return image_bruitee


#--- Bruitage Multiplicatif ---
def Bruitage_Multiplicatif(image,bruitage):
    #Copie de la matrice originale
    image_bruitee = np.copy(image)
    bruit = bruitage * 0.01         #On initialise une valeur pour avoir le sigma à utiliser, sous 1
    
    #Parcourt de la matrice
    for j in range(image_bruitee.shape[0]):         
        for i in range(image_bruitee.shape[1]):
            #Création de la valeur à affecter à chaque pixel
            t = int(math.floor(image_bruitee[j][i] * rdm.gauss(1,bruit)))       #Multiplication de la valeur du pixel avec la variable de gauss (mu,sigma)
            #Affecter la valeur en positif si elle est négative
            if (t) < 0:
                image_bruitee[j][i] = -t
            #Affecter 255 au pixel si il dépasse 255
            if (t) > 255:
                image_bruitee[j][i] = 255
            #Sinon, affecter la valeur au pixel désigné
            else:
                image_bruitee[j][i] = t
    
    #On retourne la matrice modifiée
    return image_bruitee


#--- Débruitage Median ---
def Debruitage_Median(image):
    #Copie de la matrice originale
    image_debruitee = np.copy(image)
    pixel = np.zeros((9))
    
    #Parcourt de la matrice
    for i in range(image_debruitee.shape[0]-1):
        for j in range(image_debruitee.shape[1]-1):
            #Sélectionner chaque pixel en fonction de sa position
            pixel[0] = image_debruitee[i-1,j-1]
            pixel[1] = image_debruitee[i-1,j]
            pixel[2] = image_debruitee[i-1,j+1]
            pixel[3] = image_debruitee[i,j-1]
            pixel[4] = image_debruitee[i,j]
            pixel[5] = image_debruitee[i,j+1]
            pixel[6] = image_debruitee[i+1,j-1]
            pixel[7] = image_debruitee[i+1,j]
            pixel[8] = image_debruitee[i+1,j+1]
            #Trier les pixels
            s = np.sort(pixel)  
            image_debruitee[i,j] = s[4]
    
    #On retourne la matrice modifiée
    return image_debruitee


#--- Débruitage Convulsion ---
def Debruitage_Convolution(image):
    #Copie de la matrice originale
    image_debruitee = np.copy(image)
    pixel = np.zeros((9))
    
    #Parcourt de la matrice
    for i in range(image_debruitee.shape[0]-1):
        for j in range(image_debruitee.shape[1]-1):
            #Sélectionner chaque pixel en fonction de sa position
            pixel[0] = image_debruitee[i-1,j-1]
            pixel[1] = image_debruitee[i-1,j]
            pixel[2] = image_debruitee[i-1,j+1]
            pixel[3] = image_debruitee[i,j-1]
            pixel[4] = image_debruitee[i,j]
            pixel[5] = image_debruitee[i,j+1]
            pixel[6] = image_debruitee[i+1,j-1]
            pixel[7] = image_debruitee[i+1,j]
            pixel[8] = image_debruitee[i+1,j+1]
            #Moyenne des pixels
            somme = (pixel[0]+pixel[1]+pixel[2]+pixel[3]+pixel[4]+pixel[5]+pixel[6]+pixel[7]+pixel[8])/9
            image_debruitee[i,j] = somme
    
    #On retourne la matrice modifiée
    return image_debruitee


#--- Débruitage Kuwahara ---
def variance(liste):
    #Déclaration des variables locales
    t=0
    m=(sum(liste)/len(liste))**2
    
    #Parcourt de la liste
    for i in range(len(liste)):
        t+=(liste[i]-m)**2
    
    #Retourne la variance
    return t/len(liste)


def Debruitage_Kuwahara(image):
    #Copie de la matrice originale
    image_debruitee = np.copy(image)
    #Déclaration des variables locales
    z1 = []
    z2 = []
    z3 = []
    z4 = []

    #Parcourt de la matrice
    for i in range(0,image_debruitee.shape[0]):
        for j in range(0,image_debruitee.shape[1]):
            for i1 in range(i-2,i+1):
                for j1 in range(j-2,j+1):
                    if not(i1 < 0 or i1 >= image.shape[0] or j1 < 0 or j1 >= image.shape[1]):
                        z1.append(image_debruitee[i1,j1])
            for i1 in range(i-2,i+1):
                for j1 in range(j,j+3):
                    if not(i1 < 0 or i1 >= image.shape[0] or j1 < 0 or j1 >= image.shape[1]):
                        z2.append(image_debruitee[i1,j1])
            for i1 in range(i,i+3):
                for j1 in range(j-2,j+1):
                    if not(i1 < 0 or i1 >= image.shape[0] or j1 < 0 or j1 >= image.shape[1]):
                        z3.append(image_debruitee[i1,j1])
            for i1 in range(i,i+3):
                for j1 in range(j,j+3):
                    if not(i1 < 0 or i1 >= image.shape[0] or j1 < 0 or j1 >= image.shape[1]):
                        z4.append(image_debruitee[i1,j1])
            
            #Calcul de la variance
            variances = []
            variances.append(variance(z1))
            variances.append(variance(z2))
            variances.append(variance(z3))
            variances.append(variance(z4))
            index_variance_min = variances.index(min(variances))
            if (index_variance_min == 0):
                image_debruitee[i,j] = sum(z1) / len(z1)
            elif (index_variance_min == 1):
                image_debruitee[i,j] = sum(z2) / len(z2)
            elif (index_variance_min == 2):
                image_debruitee[i,j] = sum(z3) / len(z3)
            elif (index_variance_min == 3):
                image_debruitee[i,j] = sum(z4) / len(z4)
            
            #Réinitialisation des variables locales
            z1 = []
            z2 = []
            z3 = []
            z4 = []

    #On retourne la matrice modifiée
    return image_debruitee


#--- Calcul du SNR ---
def SNR(image, image_bruitee):
    puissanceBrui = 0
    puissanceSign = 0
    for i in range(image.shape[0]):
        for j in range(image.shape[1]):
            puissanceSign = puissanceSign + (image[i,j])**2
    for i in range(image_bruitee.shape[0]):
        for j in range(image_bruitee.shape[1]):
           puissanceBrui = puissanceBrui + (image_bruitee[i,j] - image[i,j])**2     #Puissance du bruit = image bruité - image de base
    print("Bruit : "+str(puissanceBrui))
    print("Signal : "+str(puissanceSign))
    return "SNR : "+str(10*np.log(puissanceSign/puissanceBrui))


#--- Affichage de l'image ---
print("\n--- Image d'origine ---")
plt.figure(1)
plt.imshow(matrice_image, cmap='gray')
plt.show()

print("\n--- Bruitage Poivre et Sel ---")
Bruitage_PV = Bruitage_PoivreSel(matrice_image, 90)
print(SNR(matrice_image, Bruitage_PV))
plt.figure(2)
plt.imshow(Bruitage_PV, cmap='gray')
plt.show()

print("\n--- Bruitage Additif ---")
Bruitage_A = Bruitage_Additif(matrice_image, 25)
print(SNR(matrice_image, Bruitage_A))
plt.figure(3)
plt.imshow(Bruitage_A, cmap='gray')
plt.show()

print("\n--- Bruitage Multiplicatif ---")
Bruitage_M = Bruitage_Multiplicatif(matrice_image, 25)
print(SNR(matrice_image, Bruitage_M))
plt.figure(4)
plt.imshow(Bruitage_M, cmap='gray')
plt.show()

print("\n--- Débruitage Poivre et Sel ---")
Debruitage_PV = Debruitage_Median(Bruitage_PoivreSel(matrice_image, 90))
print(SNR(matrice_image, Debruitage_PV))
plt.figure(5)
plt.imshow(Debruitage_PV, cmap='gray')
plt.show()

print("\n--- Debruitage Convolution ---")
Debruitage_C = Debruitage_Convolution(Bruitage_Additif(matrice_image,25))
print(SNR(matrice_image, Debruitage_C))
plt.figure(6)
plt.imshow(Debruitage_C, cmap='gray')
plt.show()


print("\n--- Debruitage Kuwahara ---")
Debruitage_K = Debruitage_Kuwahara(Bruitage_Multiplicatif(matrice_image,25))
print(SNR(matrice_image, Debruitage_K))
plt.figure(7)
plt.imshow(Debruitage_K, cmap='gray')
plt.show()