#include <iostream>
#include <stdlib.h>
#include <time.h>

using namespace std;

int main(int argc, char *argsv[]) {
	srand(time(NULL));
	int weight1 = 7;
	int weight2 = 9;
	int weight3 = 10;

	int sel = rand() % 10;

	int val = 0; 
	if (sel < weight1) {
		val = 1;
	} else if (sel < weight2) {
		val = 2;
	} else {
		val = 3;
	}

	cout<<argsv[val]<<endl;
}
