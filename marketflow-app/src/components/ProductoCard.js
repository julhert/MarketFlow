import React from 'react';
import { View, Text, Image, TouchableOpacity } from 'react-native';
import tw from '../../tailwindApp';

export default function ProductoCard({ item, onPress }) {
  return (
    <TouchableOpacity 
      onPress={onPress}
      style={tw`bg-white m-1 p-3 rounded-2xl flex-1 shadow-sm border border-gray-100`}
    >
      {/* Contenedor de Imagen */}
      <View style={tw`bg-gray-50 rounded-xl overflow-hidden`}>
        <Image 
          source={{ uri: item.imagen }} 
          style={tw`w-full h-40`} 
          resizeMode="cover" 
        />
      </View>
      
      {/* Información del Producto */}
      <View style={tw`mt-3`}>
        <Text style={tw`text-brand-blue-400 font-bold text-sm`} numberOfLines={2}>
          {item.nombre}
        </Text>
        
        <View style={tw`flex-row justify-between items-center mt-2`}>
          <Text style={tw`text-brand-blue-200 font-extrabold text-base`}>
            ${item.precio ?? 'Sin precio'}
          </Text>
          <View style={tw`bg-brand-blue-50 px-2 py-1 rounded-md`}>
            <Text style={tw`text-brand-blue-200 text-[9px] font-bold`}>DISPONIBLE</Text>
          </View>
        </View>
      </View>
    </TouchableOpacity>
  );
}