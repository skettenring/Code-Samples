####
# Stuart Kettenring
# 6/27/2014
#
# Because I do not have any projects to use as examples
# of my programming, I have taken a few problems from
# projecteuler.net and solved them here. I hope this
# serves as a decent example of my programming abilities.
##



import time

####
# Helper functions
##

#Will determine whether or not 'n' is a prime number.
def isPrime(n):
    half = n/2
    for i in range (2, int(half)):
        if(int(n) % i == 0):
            return False

    return True

#Test efficiency of primes functions
def testingPrimes(n):

    start = time.clock() 
    isPrime(n)
    elapsed = time.clock()
    elapsed = elapsed - start
    print ("Time spent in (primeSum) is: ", elapsed)


    start = time.clock() 
    primeSum(n)
    elapsed = time.clock()
    elapsed = elapsed - start
    print ("Time spent in (isprimetest) is: ", elapsed)


####
# Problem 7:  (10001st) prime number
##
def prime(n):

    foundPrime = 1 #count starts at 2
    num = 2
    

    while (foundPrime <= n):
        num += 1
        if(isPrime(num)):
            foundPrime += 1

    print("The %d prime number is: %d"%(n, num))
    

####
# Problem 10:  sum of primes (below 2 million).
# using Sieve of Eratosthenes as algorithm.
##
def primeSum(n):

    num = []
    sqrt = n**(1/2.0) + 2
    start = 0
    step = 2

    #populate list to work with. 'p' means prime
    for i in range(2, n):
        num.append([i,'p'])

    #and 'x' means not prime
    for i in range(2, int(sqrt)):
        for j in range(start + step, len(num), step):
            if(num[j][1] == 'p'):
                num[j][1] = 'x'

        #move to next prime number to test
        start += 1
        while(num[start][1] == 'x'):
            start += 1         
        step = num[start][0]

    #then find sum
    pSum =0
    for i in range(len(num)):
        if(num[i][1] == 'p'):
            pSum += num[i][0]
            
    print("The sum of all prime numbers below 2 million is: %d"%(pSum))


















