'''
Test Pokemon - 2021
Date: 2/9/2021
Author: Jedid Santos
E-mail: jedid.santos@gmail.com
'''

#Function for verification letters is correct
def test_letters(value):
    if (value=="N") or (value=="S") or (value=="E") or (value=="O"):
        pass
    else:
        print('Capital letters only! [N S E O]')
        initial_input()

#Function for input sequence
def initial_input():
    sequence_movements = ''
    print('Enter your sequence of movements: ')
    sequence_movements = input()
    for test in sequence_movements:
        test_letters(test)
    print('Sequence: ' + sequence_movements)
    pokemons(sequence_movements)

#Function for count pokemons
def pokemons(value):
    buffer_test = ''
    pokemons = 1
    positions = 0
    for letter in value:
        if not letter in buffer_test:
            buffer_test += letter
    if len(buffer_test) == 1:
        pokemons += len(buffer_test)
    else:
        positions = len(buffer_test)-1
        pokemons += positions
    #print(buffer_test) #movements without repetition
    print('Quantos pokémons o Ash apanhou? ' + str(pokemons))
    initial_input()

while True:
    initial_input()
