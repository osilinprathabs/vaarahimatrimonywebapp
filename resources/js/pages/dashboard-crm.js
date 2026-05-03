/**
 * Template Name: Paces - Admin & Dashboard Template
 * By (Author): Coderthemes
 * Module/App (File Name): CRM Dashboard
 */

//
// Leads Generated Chart
//

import { CustomApexChart, theme, debounce } from "../app"

import jsVectorMap from "jsvectormap"
import "jsvectormap/dist/maps/world.js"
import "jsvectormap/dist/maps/world-merc.js"

new CustomApexChart({
    selector: "#leads-generated-chart",
    options: () => ({
        chart: {
            type: "area",
            height: 50,
            sparkline: {
                enabled: true,
            },
        },
        series: [
            {
                name: "Leads",
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
            fixed: { enabled: false },
            x: { show: false },
            y: {
                title: {
                    formatter: function () {
                        return "Leads"
                    },
                },
            },
            marker: { show: false },
        },
        fill: {
            opacity: [1],
            type: ["gradient"],
            gradient: {
                type: "vertical",
                inverseColors: false,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 100],
            },
        },
    }),
})

//
// Qualified Leads Chart
//
new CustomApexChart({
    selector: "#qualified-leads-chart",
    options: () => ({
        series: [70],
        chart: {
            type: "radialBar",
            height: 90,
            width: 90,
        },
        stroke: {
            lineCap: "round",
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: "45%",
                },
                dataLabels: {
                    show: false,
                },
            },
        },
        grid: {
            padding: {
                top: -20,
                bottom: -20,
                left: -20,
                right: -20,
            },
        },
        labels: ["Direct"],
        colors: [theme("chart-primary")],
    }),
})

//
// Deals Closed Chart
//
new CustomApexChart({
    selector: "#deals-closed-chart",
    options: () => ({
        chart: {
            type: "area",
            height: 50,
            sparkline: {
                enabled: true,
            },
        },
        series: [
            {
                name: "Deals",
                data: [32, 45, 38, 52, 47, 66, 70, 64, 78, 72, 81],
            },
        ],
        stroke: {
            width: 2,
            curve: "smooth",
        },
        markers: {
            size: 0,
        },
        colors: [theme("chart-primary"), theme("chart-gamma"), theme("chart-gray")],
        tooltip: {
            fixed: { enabled: false },
            x: { show: false },
            y: {
                title: {
                    formatter: function () {
                        return "Leads"
                    },
                },
            },
            marker: { show: false },
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
// Revenue Generated Chart
//
new CustomApexChart({
    selector: "#revenue-generated-chart",
    options: () => ({
        chart: {
            type: "bar",
            height: 60,
            sparkline: {
                enabled: true,
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "60%",
                borderRadius: 4,
            },
        },
        colors: [theme("chart-primary")],
        series: [
            {
                name: "Revenue",
                data: [47, 45, 74, 14, 56, 74, 14, 11, 7, 39, 82],
            },
        ],
        xaxis: {
            crosshairs: {
                width: 1,
            },
        },
        tooltip: {
            fixed: { enabled: false },
            x: { show: false },
            y: {
                formatter: function (value) {
                    return "$" + value
                },
                title: {
                    formatter: function () {
                        return "Revenue"
                    },
                },
            },
            marker: { show: false },
        },
    }),
})

//
// CRM Overview Chart
//
new CustomApexChart({
    selector: "#dash-revenue-chart",
    options: () => ({
        series: [
            {
                name: "Revenue",
                type: "area",
                data: [28, 30, 42, 43, 45, 58, 62, 64, 63, 68, 72, 56],
            },
            {
                name: "Deals Closed",
                type: "line",
                data: [20, 22, 25, 28, 26, 24, 21, 26, 30, 32, 31, 34],
            },
            {
                name: "New Leads",
                type: "bar",
                data: [38, 45, 52, 48, 56, 62, 58, 66, 60, 72, 70, 76],
            },
            {
                name: "Active Clients",
                type: "bar",
                data: [18, 20, 19, 23, 22, 25, 27, 29, 28, 31, 32, 34],
            },
        ],

        chart: {
            type: "line",
            height: 324,
            toolbar: { show: false },
            offsetX: 0,
        },

        stroke: {
            width: [2, 2, 0, 0],
            curve: "smooth",
            dashArray: [0, 4, 0, 0],
        },

        colors: [
            theme("chart-delta"), // Revenue
            theme("chart-secondary"), // Deals Closed
            theme("chart-alpha"), // New Leads
            theme("chart-gamma"), // Clients
        ],

        grid: { strokeDashArray: 1 },
        zoom: { enabled: false },

        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            axisBorder: { show: false },
            labels: { offsetY: 1 },
        },

        yaxis: {
            labels: {
                formatter: (val) => val + "k",
                offsetX: -10,
            },
            axisBorder: { show: false },
        },

        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "45%",
                borderRadius: 4,
            },
        },

        legend: { show: false },
        dataLabels: { enabled: false },
        markers: { size: 0 },

        fill: {
            opacity: [1, 1, 1, 1],
            type: ["gradient", "solid"],
            gradient: {
                type: "vertical",
                //   shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 70],
            },
        },
    }),
})

//
// Lead Source Breakdown Chart
//
new CustomApexChart({
    selector: "#most-leads-chart",
    options: () => ({
        chart: {
            height: 243,
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
                        },
                    },
                },
            },
        },
        series: [112, 234, 88, 144],
        labels: ["Newsletter", "Instagram", "WhatsApp", "Website"],
        colors: [theme("chart-primary"), theme("chart-secondary"), theme("chart-alpha"), theme("chart-gray")],
        dataLabels: {
            enabled: false,
        },
        responsive: [
            {
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200,
                    },
                },
            },
        ],
    }),
})

//
// Location By Session
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

            selectedRegions: ["AU", "US", "IN"], // highlight these countries
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
