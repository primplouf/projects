#include <iostream>
#include <cstdlib>
#include "banque.h"

using namespace std;

banque::banque(int x = 10){
    nbc = 0;
    nbct = x;
    comptes = new compte[nbct];
}

//Constructeur de recopie

banque::banque(const banque& bq){
    nbc = bq.nbc;
    nbct = bq.nbct;
    comptes = bq.comptes;
}

banque::~banque(){
    delete [] comptes;
}

compte banque::getCompte(int num){
    compte c;
    for(int i=0; i<nbc; i++){
        if(comptes[i].getNumero() == num){
            c = comptes[i];
        }
    }
    return c;
}

int banque::getNbc(){ return nbc; }
int banque::getNbct(){ return nbct; }

void banque::ajouteCompte(string nom, float solde, float decouvertmax){
    compte c(nom, solde, decouvertmax);
    int temp = nbct-1;
    int redim = nbct+1;
    if (nbc<temp){
        comptes[nbc] = c;
    } else {
        banque::redimensionneTableau(redim);
        comptes[nbc] = c;  
    }
    cout << "______________________________" << endl;
    cout << "Le compte a bien ete ajoute :" << endl;
    c.afficher();
    nbc++;
}

bool banque::checkNumeroComptes(int num){
    bool verifNum = false;
    for (int i=0; i<nbc; i++){
        if(comptes[i].getNumero()==num){
            verifNum = true;
        }
    }
    return verifNum;
}

void banque::supprimeCompte(string nom){
    bool compteSupprime = false;
    for (int i = 0; i<nbc; i++){
        if(comptes[i].getNom() == nom){
            compteSupprime = true;
            comptes[i] = comptes[i+1];
        } else if (compteSupprime){
            comptes[i] = comptes[i+1];
        }
        int temp = nbct -1;
        redimensionneTableau(temp);
    }
    nbc--;
    cout << "______________________________" << endl;
    cout << "Le compte a bien ete supprime" << endl;;
    afficheAllComptes();
}

void banque::supprimeCompte(int numeroCompte){
    bool compteSupprime = false;
    for (int i = 0; i<nbc; i++){
        if(comptes[i].getNumero() == numeroCompte){
            compteSupprime = true;
            comptes[i] = comptes[i+1];
        } else if (compteSupprime){
            comptes[i] = comptes[i+1];
        }
        int temp = nbct -1;
        redimensionneTableau(temp);
    }
    nbc--;
    cout << "______________________________" << endl;
    cout << "Le compte a bien ete supprime" << endl;;
    afficheAllComptes();
}

void banque::afficheCompte(int numeroCompte){
    bool compteAffiche = false;
    int i = 0;
    while (i < nbc && !compteAffiche){
        compteAffiche = true;
        comptes[i].afficher();
        i++;
    }
}

void banque::afficheAllComptes(){
    for (int i=0; i<nbc; i++){
        comptes[i].afficher(); 
    }
}

void banque::redimensionneTableau(int nb){
    compte * newtab = new compte[nb];
    for (int i=0; i<nbc; i++){
        newtab[i] = comptes[i]; 
    }
    delete [] comptes;
    comptes = newtab;
    nbct = nb;
}