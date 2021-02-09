'''
Test Mobiqam - 2021
Date: 2/8/2021
Author: Jedid Santos
E-mail: jedid.santos@gmail.com
'''

import numpy as np
import itertools
import string

vectorLetters = np.array([' ','ABC','DEF','GHI','JKL','MNO','PQRS','TUV','WXYZ'])
'''
1 - nothing
2 - ABC
3 - DEF
4 - GHI
5 - JKL
6 - MNO
7 - PQRS
8 - TUV
9 - WXYZ

'''


vectorCombination = []
#function to collect strings and separate data for combinations
def input_menu():
    print('Enter the numeric string: ')
    sequence = input()
    #input data checks
    if "0" in sequence:
        print('Only numers 1-9')
        exit()
    if not sequence.isdigit():
        print('Only numbers! Informed data is not a number')
        exit()
    else:
        print('Sequence: ' + sequence)

        for number in sequence:
            number = int(number)
            posicao_vectorLetters = vectorLetters[number-1] 
            vectorCombination.append(posicao_vectorLetters)
    print(vectorCombination)

#Function for combinations
def combinations():
    combinationsList = itertools.product(*vectorCombination)
    print('Combinations List:')
    print(list(combinationsList))
    exit()


#Loop
while True:
    input_menu()
    combinations()


    

    

