/**
 * Template Name: Paces - Admin & Dashboard Template
 * By (Author): Coderthemes
 * Module/App (File Name): Finance Dashboard
 */

//
// Show/Hide Balance
//

import { CustomApexChart, theme, debounce } from "../app"

document.addEventListener("DOMContentLoaded", () => {
    const balanceEl = document.getElementById("user-balance-number")
    const toggleArea = document.getElementById("user-b-show-hide")

    let originalBalance = balanceEl.textContent.trim()
    let isHidden = false

    toggleArea.addEventListener("click", (e) => {
        e.preventDefault()
        isHidden = !isHidden

        if (isHidden) {
            // Keep only the first character ($) and mask the rest
            const masked = originalBalance[0] + "*".repeat(originalBalance.length - 1)
            balanceEl.textContent = masked
        } else {
            balanceEl.textContent = originalBalance
        }
    })
})

//
// Total Income Chart
//
new CustomApexChart({
    selector: "#total-income-chart",
    options: () => ({
        chart: {
            type: "area",
            height: 51,
            sparkline: {
                enabled: true,
            },
        },
        series: [
            {
                data: [25, 28, 32, 38, 43, 55, 60, 48, 42, 51, 35],
            },
        ],
        stroke: {
            width: 2,
            curve: "smooth",
        },
        markers: {
            size: 0,
        },
        colors: [theme("chart-primary")],
        tooltip: {
            fixed: {
                enabled: false,
            },
            x: {
                show: false,
            },
            y: {
                title: {
                    formatter: function (seriesName) {
                        return ""
                    },
                },
            },
            marker: {
                show: false,
            },
        },
        fill: {
            opacity: [1],
            type: ["gradient"],
            gradient: {
                type: "vertical",
                //   shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 100],
            },
        },
    }),
})

//
// Total Expenses Chart
//
new CustomApexChart({
    selector: "#total-expenses-chart",
    options: () => ({
        chart: {
            type: "area",
            height: 51,
            sparkline: {
                enabled: true,
            },
        },
        series: [
            {
                data: [10, 18, 25, 28, 35, 50, 48, 43, 20, 31, 15],
            },
        ],
        stroke: {
            width: 2,
            curve: "smooth",
        },
        markers: {
            size: 0,
        },
        colors: [theme("chart-primary")],
        tooltip: {
            fixed: {
                enabled: false,
            },
            x: {
                show: false,
            },
            y: {
                title: {
                    formatter: function (seriesName) {
                        return ""
                    },
                },
            },
            marker: {
                show: false,
            },
        },
        fill: {
            opacity: [1],
            type: ["gradient"],
            gradient: {
                type: "vertical",
                //   shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 100],
            },
        },
    }),
})

//
// Investments Chart
//
new CustomApexChart({
    selector: "#investments-chart",
    options: () => ({
        chart: {
            type: "area",
            height: 51,
            sparkline: {
                enabled: true,
            },
        },
        series: [
            {
                data: [10, 14, 18, 22, 26, 30, 20, 10, 5, 25, 35],
            },
        ],
        stroke: {
            width: 2,
            curve: "smooth",
        },
        markers: {
            size: 0,
        },
        colors: [theme("chart-primary")],
        tooltip: {
            fixed: {
                enabled: false,
            },
            x: {
                show: false,
            },
            y: {
                title: {
                    formatter: function (seriesName) {
                        return ""
                    },
                },
            },
            marker: {
                show: false,
            },
        },
        fill: {
            opacity: [1],
            type: ["gradient"],
            gradient: {
                type: "vertical",
                //   shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 100],
            },
        },
    }),
})

//
// Savings Chart
//
new CustomApexChart({
    selector: "#savings-chart",
    options: () => ({
        chart: {
            type: "area",
            height: 51,
            sparkline: {
                enabled: true,
            },
        },
        series: [
            {
                data: [45, 38, 36, 22, 32, 36, 45, 55, 50, 42, 25],
            },
        ],
        stroke: {
            width: 2,
            curve: "smooth",
        },
        markers: {
            size: 0,
        },
        colors: [theme("chart-primary")],
        tooltip: {
            fixed: {
                enabled: false,
            },
            x: {
                show: false,
            },
            y: {
                title: {
                    formatter: function (seriesName) {
                        return ""
                    },
                },
            },
            marker: {
                show: false,
            },
        },
        fill: {
            opacity: [1],
            type: ["gradient"],
            gradient: {
                type: "vertical",
                //   shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 100],
            },
        },
    }),
})

//
// Financial Overview Chart
//
new CustomApexChart({
    selector: "#financial-overview-chart",
    options: () => ({
        series: [
            {
                name: "Total Income",
                type: "bar",
                data: [89.25, 98.58, 68.74, 108.87, 77.54, 84.03, 51.24, 28.57, 92.57, 42.36, 88.51, 36.57],
            },
            {
                name: "Total Expenses",
                type: "bar",
                data: [22.25, 24.58, 36.74, 22.87, 19.54, 25.03, 29.24, 10.57, 24.57, 35.36, 20.51, 17.57],
            },
            {
                name: "Investments",
                type: "area",
                data: [34, 65, 46, 68, 49, 61, 42, 44, 78, 52, 63, 67],
            },
            {
                name: "Savings",
                type: "line",
                data: [8, 12, 7, 17, 21, 11, 5, 9, 7, 29, 12, 35],
            },
        ],
        chart: {
            height: 376,
            type: "line",
            toolbar: {
                show: false,
            },
        },
        stroke: {
            dashArray: [0, 0, 0, 8],
            width: [0, 0, 2, 2],
            curve: "smooth",
        },
        fill: {
            opacity: [1, 1, 0.1, 1],
            type: ["gradient", "solid", "solid", "solid"],
            gradient: {
                type: "vertical",
                //   shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 70],
            },
        },
        markers: {
            size: [0, 0, 0, 0],
            strokeWidth: 2,
            hover: {
                size: 4,
            },
        },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
        },
        yaxis: {
            min: 0,
            labels: {
                formatter: function (val) {
                    return val + "k"
                },
            },
            axisBorder: {
                show: false,
            },
        },
        grid: {
            show: true,
            xaxis: {
                lines: {
                    show: false,
                },
            },
            yaxis: {
                lines: {
                    show: true,
                },
            },
            padding: {
                top: 0,
                right: -2,
                bottom: 15,
                left: 10,
            },
        },
        legend: {
            show: true,
            horizontalAlign: "center",
            offsetX: 0,
            offsetY: -5,
            markers: {
                width: 9,
                height: 9,
                radius: 6,
            },
            itemMargin: {
                horizontal: 10,
                vertical: 0,
            },
        },
        plotOptions: {
            bar: {
                columnWidth: "50%",
                barHeight: "70%",
                borderRadius: 3,
            },
        },
        colors: [theme("chart-primary"), theme("chart-gamma"), theme("chart-gray"), theme("chart-secondary")],
        tooltip: {
            shared: true,
            y: [
                {
                    formatter: function (y) {
                        if (typeof y !== "undefined") {
                            return "$" + y.toFixed(2) + "k"
                        }
                        return y
                    },
                },
                {
                    formatter: function (y) {
                        if (typeof y !== "undefined") {
                            return "$" + y.toFixed(2) + "k"
                        }
                        return y
                    },
                },
                {
                    formatter: function (y) {
                        if (typeof y !== "undefined") {
                            return "$" + y.toFixed(2) + "k"
                        }
                        return y
                    },
                },
                {
                    formatter: function (y) {
                        if (typeof y !== "undefined") {
                            return "$" + y.toFixed(2) + "k"
                        }
                        return y
                    },
                },
            ],
        },
    }),
})
