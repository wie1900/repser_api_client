Source = class {
    #array;
    #sourceTextarea;
    #maxInPart = 500; // default value, enough for most servers to process data efficiently
    arrayLength;

    constructor(sourceTextarea){
        this.#sourceTextarea = sourceTextarea;
        this.setArray();
    }

    getMaxInPart = function(){
        return this.#maxInPart;
    }

    setMaxInPart = function(new_max){
        this.#maxInPart = new_max;
        this.setArray();
    }

    getArray = function(){
        return this.#array;
    }

    setArray = function(){
        var mainArray = this.#sourceTextarea.val().split('\n');
        mainLen = Object.keys(mainArray).length;
        this.arrayLength = mainLen;
        var row=0;
        var col=0;
        var colmax = this.#maxInPart;
        
        var subArray = [];

        for(let i=0;i<mainLen;i++){
            if(col==0){
                subArray[row] = [];
                subArray[row][col] = mainArray[i];
                col++;
                } else {
                if(col < colmax){
                    subArray[row][col] = mainArray[i];
                    col++;
                }else{
                    row++;
                    col=0;
                    subArray[row] = [];
                    subArray[row][col] = mainArray[i];
                    col++;
                }
            }
        }
        this.#array = subArray;
    }
}