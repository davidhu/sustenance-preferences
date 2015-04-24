#include <iostream>

using namespace std;

#define DEBUG 1

double rng(double* nums,int size);

int main(void){
  srand(time(NULL));
  double nums[] = {1,1,1,3,2,7};
  rng(nums,sizeof(nums)/sizeof(double));
}

double rng(double nums[],int size){
  double* weights = new double[size];
  double total = 0;
  double sel = (rand() % 100)/100.0;
  if(DEBUG) cout << "Select: "<< sel << endl;

  for (size_t i = 0; i < size; ++i){//get total
    total += nums[i]; 
  }

  if(DEBUG) cout << "Total: " << total << endl;

  for (size_t i = 0; i < size; ++i){//get the weight of each number
    weights[i] = nums[i] / total;
  }

  if(DEBUG){
    cout << "Numbers: ";
    for(size_t i =0; i < size; ++i){
      cout << nums[i] << " ";
    }
    cout << endl;
  }

  if(DEBUG){
    cout << "Weights: ";
    for(size_t i =0; i < size; ++i){
      cout << weights[i] << " ";
    }
    cout << endl;
  }

  double max = 0.0;

  for (size_t i = 0; i < size ; ++i){
    max += weights[i];
    if(sel <= max){ 
      if(DEBUG) cout << "Returned: " << i+1 << endl;
      return (i+1);
    }
  }
  

  delete[] weights;
}
