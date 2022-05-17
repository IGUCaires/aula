#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main (void)
{
char frase[50];
int i=0, flag=0, total=0;
int tamanho = strlen(frase);
char *token = strtok(frase, " ");
printf("Introduza a frase\n");
gets(frase);

for(i=0;frase[i]!='\0';i++) {
	if(!flag && frase[i]!=' ') { 

		flag=1;
		total++;
	}
	else if(flag && frase[i]==' ')
		flag=0;
}

 for (int i = 0; i < tamanho; i++) {
      printf(frase[i] == 0 ? "\\0" : "%c", frase[i]);
 }
    while(token != NULL) {
        printf("%s\n", token);
        token = strtok(NULL, " ");
    }

printf("O numero de palavras e: %d\n",total);

return 0;
}
