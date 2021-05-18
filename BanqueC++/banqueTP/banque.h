#include <iostream>
#include <cstdlib>
#include <vector>
#include "compte.h"
#pragma once

using namespace std;

class banque{
    private :
    int nbc;
    int nbct;
    compte *comptes;

    public:
    banque(int);
    banque(const banque&);
    ~banque();

    int getNbc();
    int getNbct();
    compte getCompte(int);
    bool checkNumeroComptes(int);
    void ajouteCompte(string, float, float);
    void supprimeCompte(string);
    void supprimeCompte(int);
    void afficheCompte(int);
    void afficheAllComptes();

    private :
    void redimensionneTableau(int);
};