<template>
  <div class="calculator">
            <div class="display">{{ current || '0' }}</div>
            <div @click="clear" class="btn">C</div>
            <div @click="sign" class="btn">+/-</div>
            <div @click="percent" class="btn">%</div>
            <div @click="divide" class="btn operator">÷</div>
            <div @click="append('7')" class="btn">7</div>
            <div @click="append('8')" class="btn">8</div>
            <div @click="append('9')" class="btn">9</div>
            <div @click="times" class="btn operator">x</div>
            <div @click="append('4')" class="btn">4</div>
            <div @click="append('5')" class="btn">5</div>
            <div @click="append('6')" class="btn">6</div>
            <div @click="minus" class="btn operator">-</div>
            <div @click="append('1')" class="btn">1</div>
            <div @click="append('2')" class="btn">2</div>
            <div @click="append('3')" class="btn">3</div>
            <div @click="add" class="btn operator">+</div>
            <div @click="append('0')" class="btn zero">0</div>
            <div @click="dot" class="btn">.</div>
            <div @click="equal" class="btn operator">=</div>
        </div>
    
</template>

<script>
export default {
  data() {
    return {
      previous: null,
      current: '',
      operator: null,
      operatorClicked: false,
    }
  },
  methods: {
    clear() {
      this.current = '';
    },
    sign() {
      let payload = {
					previous: this.current,
          current: -1,
          operator : "times",
				};

			 this.calcul(payload);
    },
    percent() {
      let payload = {
					previous: this.current,
          current: 100 ,
          operator : "divide",
				};

			 this.calcul(payload);
    },
    append(number) {
      if (this.operatorClicked) {
        this.current = '';
        this.operatorClicked = false;
      }
      this.current = `${this.current}${number}`;
    },
    dot() {
      if (this.current.indexOf('.') === -1) {
        this.append('.');
      }
    },
    setPrevious() {
      this.previous = this.current;
      this.operatorClicked = true;
    },
    divide() {
      // this.operator = (a, b) => a / b;
      this.operator="divide";
       this.setPrevious();
    },
    times() {
      // this.operator = (a, b) => a * b;
      this.operator="times";
      this.setPrevious();
    },
    minus() {
      // this.operator = (a, b) => a - b;
      // this.setPrevious();
      this.operator="minus";
      this.setPrevious();
    },
    add() {
      // this.operator = (a, b) => a + b;
      // this.setPrevious();
      this.operator="add";
      this.setPrevious();
    },
  
   equal() {
      	let payload = {
					previous: this.previous,
          current: this.current,
          operator : this.operator,
				};

			 this.calcul(payload);
    },
       async calcul(payload) {
      
				try {
					let data = (await axios.post('/api/calculator', payload)).data;
					this.current = data.result;
          this.previous = null;
				} catch(error) {
					this.error = error.response.data;
				}
    }

  }
}
</script>

<style>
    .calculator {
        margin: 0 auto; 
        width: 400px; 
        font-size: 40px;
        display: grid;
       margin-top : 100px; 
        grid-template-columns: repeat(4, 1fr);
        grid-auto-rows: minmax(50px, auto);
    }

    .display {
        grid-column: 1/5;
        background-color: #333;
        color: white;
        

    }

    .zero {
        grid-column: 1 / 3;
    }

    .btn {
        background-color: #F2F2F2;
        border: 1px solid #999;
    }

    .operator {
        background-color: orange;
        color: white;
    }
</style>