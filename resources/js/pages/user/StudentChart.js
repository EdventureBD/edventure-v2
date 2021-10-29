import React, { Component } from "react";

class StudentChart extends Component {
  
    constructor(props) {
      super(props)
      this.options = {
        type: 'line',
        data: {
          labels: props.results.labels,
          datasets: [{
            label: "MCQ",
            backgroundColor: 'rgba(251, 134, 224, 0.2)',
            borderColor:'#FB86E0',
            data: props.results.mcq
          }, {
            label: "CQ",
            backgroundColor: 'rgba(88, 64, 184, 0.2)',
            borderColor:'#5840B8',
            data: props.results.cq
          }]
        },
        options: {
          scales: {
            xAxes: [{
              display: true,
              beginAtZero: true
            }],
            yAxes: [{
              type: "linear",
              display: true,
              position: "left",
              beginAtZero: true
            }]
          },
          responsive: true
        }
      }
      this.toggleChart = this.toggleChart.bind(this)
    }
    
    toggleChart() {
      this.options.type = this.options.type === 'line' ? 'bar' : 'line'
      this.chart.destroy()
      this.chart = new Chart(this.ctx, this.options)
    }
    
    componentDidMount() {
      this.canvas = document.querySelector('canvas')
      this.ctx = this.canvas.getContext('2d')
      this.chart = new Chart(this.ctx, this.options)
    }
    
    render() {
      return (
        <div>
          <canvas />
          {/* <div className="text-center">
            <button className="btn btn-primary" onClick={this.toggleChart}>Toggle</button>
          </div> */}
        </div>
      )
    }
  }

  export default StudentChart;