/**
 * Template Name: Paces - Admin & Dashboard Template
 * By (Author): Coderthemes
 * Module/App (File Name): Analytics Dashboard
 */

//
// Total Orders
//

import { CustomApexChart, theme, debounce } from "../app"

import jsVectorMap from "jsvectormap"
import "jsvectormap/dist/maps/world.js"
import "jsvectormap/dist/maps/world-merc.js"

var categories = []
for (var i = 1; i <= 15; i++) {
    categories.push(i + "D")
}

function getRandomOrders(length) {
    var d = []
    for (var idx = 0; idx < length; idx++) {
        d.push(Math.floor(Math.random() * 90) + 30) // 30–120 orders
    }
    return d
}

// Refunds = 5% to 15% of Orders
function getRefundsFromOrders(orders) {
    return orders.map((v) => {
        var percent = (Math.random() * (15 - 5) + 5) / 100 // 5–15%
        return Math.round(v * percent)
    })
}

var ordersData = getRandomOrders(15)
var refundsData = getRefundsFromOrders(ordersData)

new CustomApexChart({
    selector: "#total-orders-chart",
    options: () => ({
        chart: {
            height: 263,
            type: "bar",
            stacked: true,
            toolbar: {
                show: false,
            },
        },

        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: "rounded",
                columnWidth: "35%",
            },
        },

        series: [
            {
                name: "Orders",
                data: ordersData,
            },
            {
                name: "Refunds",
                data: refundsData,
            },
        ],

        dataLabels: {
            enabled: false,
        },

        markers: {
            size: 0,
            style: "hollow",
        },

        colors: [theme("chart-primary"), theme("chart-alpha")],

        fill: {
            type: "gradient",
            gradient: {
                inverseColors: true,
                shade: "light",
                type: "vertical",
                opacityFrom: 0.75,
                opacityTo: 1,
                stops: [0, 25, 50, 100],
            },
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function (val) {
                    return val
                },
            },
        },
        xaxis: {
            categories: categories,
            tickAmount: 6,
            labels: {
                rotate: 0,
                formatter: function (val) {
                    return val + "D" // add "Day" to each visible label
                },
                style: {
                    fontSize: "11px",
                    whiteSpace: "nowrap",
                },
            },
            tickPlacement: "on",
        },
        legend: {
            offsetY: 15,
        },
        grid: {
            borderColor: [theme("chart-order-color")],
            padding: {
                top: -10,
                right: 0,
                bottom: -10,
                left: 10,
            },
        },
    }),
})

//
// Sessions Overview
//
const sessionButtons = document.querySelectorAll(".nav-link[id]")

const sessionsChart = new CustomApexChart({
    selector: "#sessions-overview-users",
    options: () => getMetricChartConfig("session-users", theme),
})

sessionButtons.forEach((button) => {
    button.addEventListener("click", function () {
        sessionButtons.forEach((btn) => btn.classList.remove("active"))
        this.classList.add("active")

        const metricId = this.id
        const newOptions = getMetricChartConfig(metricId, theme)

        sessionsChart.chart.updateOptions(newOptions, true)
    })
})

function getMetricChartConfig(metric, theme) {
    const generateRandomData = (count, min, max) => {
        return Array.from({ length: count }, () => Math.floor(Math.random() * (max - min + 1)) + min)
    }

    const metricSettings = {
        "session-users": {
            visitors: [16, 19, 19, 16, 16, 14, 15, 15, 17, 17, 19, 19, 18, 18, 20, 20, 18, 18, 22, 22, 20, 20, 18, 18, 20, 20, 18, 20, 20, 22],
            pageViews: [21, 24, 24, 21, 21, 19, 20, 20, 22, 22, 24, 24, 23, 23, 25, 25, 23, 23, 27, 27, 25, 25, 23, 23, 25, 25, 23, 25, 25, 27],
            formatter: (val) => val + "k",
        },
        "total-sessions": {
            visitors: generateRandomData(30, 20, 40),
            pageViews: generateRandomData(30, 25, 50),
            formatter: (val) => val + "k",
        },
        "session-bounce-rate": {
            visitors: generateRandomData(30, 30, 60),
            pageViews: generateRandomData(30, 40, 70),
            formatter: (val) => val + "%",
        },
        "session-duration": {
            visitors: generateRandomData(30, 60, 200),
            pageViews: generateRandomData(30, 100, 300),
            formatter: (val) => {
                const mins = Math.floor(val / 60)
                const secs = val % 60
                return `${mins}m ${secs}s`
            },
        },
    }

    const setting = metricSettings[metric] || metricSettings["session-users"]

    return {
        series: [
            {
                name: "Visitors",
                data: setting.visitors,
            },
            {
                name: "Page Views",
                data: setting.pageViews,
            },
        ],
        chart: {
            type: "area",
            height: 328,
            toolbar: { show: false },
        },
        stroke: {
            width: [2, 2],
            dashArray: [0, 5],
            curve: "smooth",
        },
        colors: [theme("chart-primary"), theme("chart-gamma")],
        grid: {
            strokeDashArray: 7,
        },
        xaxis: {
            type: "category",
            axisBorder: { show: false },
            labels: { offsetY: 2 },
        },
        yaxis: {
            tickAmount: 3,
            min: 0,
            labels: {
                formatter: setting.formatter,
                offsetX: -10,
            },
        },
        legend: { show: false },
        dataLabels: { enabled: false },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.35,
                opacityTo: 0,
                stops: [0, 95],
            },
        },
        tooltip: {
            y: {
                formatter: setting.formatter,
            },
        },
    }
}

// Active Users Countdown
function animateCounter(element, start, end, duration = 800) {
    const range = end - start
    const startTime = performance.now()

    function update(now) {
        const progress = Math.min((now - startTime) / duration, 1)
        const value = Math.floor(start + range * progress)
        element.textContent = value

        if (progress < 1) requestAnimationFrame(update)
    }

    requestAnimationFrame(update)
}

// Check if the elements exist before trying to animate them
const activeUsersEl = document.getElementById("active-users-count")
const activeViewsEl = document.getElementById("active-views-count")

if (!activeUsersEl || !activeViewsEl) {
    console.error("Elements active-users-count or active-views-count not found")
}

setInterval(() => {
    const ac = Math.floor(Math.random() * 150 + 150)
    const views = Math.floor(Math.random() * ac + 25)

    // animate counters
    animateCounter(activeUsersEl, Number(activeUsersEl.textContent), ac)
    animateCounter(activeViewsEl, Number(activeViewsEl.textContent), views)
}, 2000)

//
// Audience Insights Chart
//
new CustomApexChart({
    selector: "#total-users-chart",
    options: () => ({
        chart: {
            height: 160,
            type: "donut",
        },
        legend: {
            show: false,
        },
        stroke: {
            width: 0,
        },

        plotOptions: {
            pie: {
                donut: {
                    size: "75%",
                    labels: {
                        show: true,
                        total: {
                            showAlways: true,
                            show: true,
                            formatter: function (w) {
                                return (
                                    w.globals.seriesTotals.reduce((a, b) => {
                                        return a + b
                                    }, 0) + "k"
                                )
                            },
                        },
                    },
                },
            },
        },
        series: [44, 55, 41],
        labels: ["Organic", "Referral", "Paid"],
        colors: [theme("chart-primary"), theme("chart-zeta"), theme("chart-alpha")],
        dataLabels: {
            enabled: false,
        },
        responsive: [
            {
                breakpoint: 480,
                options: {
                    chart: {
                        width: 180,
                    },
                },
            },
        ],
    }),
})

//
// Sessions by Country Map
//
class VectorMap {
    currentResizeHandler = null

    init() {
        this.initWorldMarkerLine()
    }

    initVectorMap(selector, options = {}) {
        let element = null

        if (selector instanceof Element) {
            element = selector
        } else {
            element = document.querySelector(selector)
        }

        if (element) {
            const svgElement = element.querySelector("svg")

            if (svgElement) {
                const mapInstance = element.jsVectorMap

                if (mapInstance && typeof mapInstance.destroy === "function") {
                    mapInstance.destroy()
                } else {
                    // Fallback for cases where the instance is missing but the SVG remains.
                    element.innerHTML = ""
                }
            }

            if (this.currentResizeHandler) {
                window.removeEventListener("resize", this.currentResizeHandler)
                this.currentResizeHandler = null
            }

            const map = new jsVectorMap({
                selector: element,
                ...options,
            })

            const debouncedUpdate = debounce(() => {
                map.updateSize()
            }, 200)

            this.currentResizeHandler = debouncedUpdate

            window.addEventListener("resize", this.currentResizeHandler)
        }
    }

    initWorldMarkerLine() {
        this.initVectorMap("#session-by-countries", {
            map: "world",
            zoomOnScroll: false,
            zoomButtons: true,

            regionStyle: {
                initial: {
                    stroke: "#aab9d14d",
                    strokeWidth: 0.25,
                    fill: "#aab9d14d",
                    fillOpacity: 1,
                },
                selected: {
                    fill: theme("primary"), // highlight color
                },
            },

            selectedRegions: ["CA", "US", "RU", "IN"], // highlight these countries
        })
    }
}

document.addEventListener("DOMContentLoaded", function (e) {
    new VectorMap().init()
})

// Observe theme changes
const mapObserver = new MutationObserver(() => {
    new VectorMap().init()
})

mapObserver.observe(document.documentElement, {
    attributes: true,
    attributeFilter: ["data-skin", "data-bs-theme"],
})
