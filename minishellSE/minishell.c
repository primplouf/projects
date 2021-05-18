#include "ligne_commande.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/wait.h>
#include <fcntl.h>

int main(){

    char** com;

    while(1){ //On cree une boucle infinie

        printf("Prompt>");fflush(stdout); //On affiche le prompt a chaque passage dans la boucle

	    com = lis_ligne(); //Decoupe une ligne de texte selon les espaces et la place dans com

        if (fin_de_fichier(com)) {

            exit (0); //Si l'utilisateur appuie sur ctrl + D on ferme le shell

        } else if(strcmp(com[0], "export")==0){ //Si l'utilisateur entre la commande interne export

	    char* chainentiere = com[1];
	    char* chaine;
            if ((chaine = separe_egal(chainentiere))==0){ //On sépare la chaine après le export, la variable dans chaineentiere et la valeur dans chaine
                perror("Erreur separe_egal"); //On signale si il y a eu une erreur lors du separe_egal
            } else {
                setenv(chainentiere, chaine, 1); //On assigne sa valeur a la variable
            }
	
        } else if(strcmp(com[0], "cd")==0){ //Si l'utilisateur entre la commande interne cd

            chdir(com[1]); //On effectue la commande directement dans le shell

        } else if(strcmp(com[0], "exit")==0){ //Si l'utilisateur entre la comande interne exit

            exit (0); //On effectue la commande directement dans le shell

        } else {

            if (ligne_vide(com)!=1){ //Si une ligne a ete saisie on continue

                int retourFork, codeRetour; 
		        retourFork = fork(); 

                if(retourFork>0){

                    wait(&codeRetour); //On attend que la commande soit executee

                }

                if(retourFork==0){
                    
                    int i = 0, count = 0, count2 = 0, poscoup = 0, poscoup2 =0, posadd = 0, posadd2 =0 ,fd, fd2;

                    while (com[i]!=NULL){
                        if (strcmp(com[i], ">")==0){
                            count = count+1;
                            poscoup = i+1;
                        } else if (strcmp(com[i], "2>")==0){
                            count = count+1;
                            poscoup2 = i+1;
                        } else if (strcmp(com[i], ">>")==0){
                            count2 = count2+1;
                            posadd = i+1;
                        } else if (strcmp(com[i], "2>")==0){
                            count2 = count2+1;
                            posadd2 = i+1;
                        }
                        i = i + 1;
                    }

                    if (count!=0){
                        if (count == 1){
                            if (fd = open(com[poscoup], O_WRONLY | O_TRUNC | O_CREAT)==-1){
                                "Fichier introuvable";
                            }
                            dup2(fd,1);
                            close(fd);    
                        } else {
                            if (fd = open(com[poscoup], O_WRONLY | O_TRUNC | O_CREAT)==-1){
                                "Fichier introuvable";
                            }
                            dup2(fd,1);
                            close(fd);
                            if (fd2 = open(com[poscoup2], O_WRONLY | O_TRUNC | O_CREAT)==-1) {
                                "Fichier introuvable";
                            } 
                            dup2(fd2,2);
                            close(fd2);
                        }
                    }

                    if (count2!=0){
                        if (count2 == 1){
                            if (fd = open(com[posadd], O_WRONLY | O_APPEND | O_CREAT)==-1){
                                "Fichier introuvable";
                            } 
                            dup2(fd,1);
                            close(fd);    
                        } else {
                            if (fd = open(com[posadd], O_WRONLY | O_APPEND | O_CREAT)==-1){
                                "Fichier introuvable";
                            }
                            dup2(fd,1);
                            close(fd);
                            if (fd2 = open(com[posadd2], O_WRONLY | O_APPEND | O_CREAT)==-1){
                                "Fichier introuvable";
                            } 
                            dup2(fd2,2);
                            close(fd2);
                        }
                    }

                    if (execvp(com[0],com)<0){

		            perror("Erreur execvp"); //On declenche une erreur si la commande ne fonctionne pas
		            }

                    return(2);

                }

                if(retourFork<0){

                    perror("Erreur fork"); //On declenche une erreur si le fork n'a pas fonctionnee

                }
            }
        }
    }
}