#include <iostream>
#include <cstdlib>
#include "compte.h"

using namespace std;

int compte::numeroAttribue = 0;

compte::compte(string nom, float sommeInit, float decouvertmax){
    numeroCompte = numeroAttribue;
    nomCompte = nom;
    soldeCompte = sommeInit;
    decouvertMax = decouvertmax;
    numeroAttribue = numeroAttribue+1;
}
compte::compte(const compte &cpt){
    numeroCompte = numeroAttribue;
    nomCompte = cpt.nomCompte;
    soldeCompte = 0;
    decouvertMax = 0;
    numeroAttribue = numeroAttribue+1;
}
compte::compte(){};
compte::~compte() {}

int compte::getNumero() const{ return this->numeroCompte; }
string compte::getNom() const{ return this->nomCompte; }
float compte::getSolde() const{ return this->soldeCompte; }
float compte::getDecouvertmax() const{ return this->decouvertMax; }
int compte::getDernierNumeroAttribue() { int lastnum;lastnum = numeroAttribue-1; return lastnum; }
void compte::debiter(float somme){ 
    cout << "__________Debiter____________" << endl;
    float temp = soldeCompte - somme;
    if (decouvertMax<temp){
        soldeCompte -= somme;
        cout << "La somme a bien ete debitee" << endl;
    } else {
        cout << "Operation refusee, solde trop bas" << std::endl;
    }
    this->afficher();
}
void compte::crediter(float somme){
    cout << "__________Crediter____________" << endl;
    this->soldeCompte += somme;
    cout << "La somme a bien ete creditee" << endl;
    this->afficher();
}
void compte::afficher() const{
    cout << "___________Compte_____________" << endl;
    cout << "Numero de compte : " << this->getNumero() << endl;
    cout << "Nom : " << this->getNom() << endl;
    cout << "Solde : " << this->getSolde() << endl;
    cout << "Decouvert maximum : " << this->getDecouvertmax() << endl;
    cout << "______________________________" << endl;
}


