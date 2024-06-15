<script setup>
import { ref, onMounted } from "vue";
import io from 'socket.io-client';
import { StreamBarcodeReader } from "vue-barcode-reader";

const socket = io(':6999');
const decodedText = ref("");

const onLoaded = () => {
    console.log("loaded");
};

onMounted(() => {
    socket.on("connect", () => {
        console.log('Socket Connect Status: ' + socket.connected);
        console.log('Socket ID: ' + socket.id);
    });
});

const onDecode = (text) => {
    decodedText.value = text;
    const jsonString = JSON.parse(text);
    const textScanned = jsonString.text;
    const statusScanned = jsonString.status;
    console.log("Scanned: ", statusScanned);

    if(statusScanned === "success") {
        socket.emit('scanner', textScanned);
        console.log("Success");
    } else {
        console.log("Failed");
    }
};
</script>

<template>
    <StreamBarcodeReader @decode="onDecode" @loaded="onLoaded"></StreamBarcodeReader>
    <h2>The decoded value in QR/barcode is</h2>
    <h2>{{ decodedText }}</h2>
</template>

<style scoped></style>
