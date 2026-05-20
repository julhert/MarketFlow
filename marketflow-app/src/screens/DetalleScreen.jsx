import React from 'react';
import { View, Text, Image, FlatList, ActivityIndicator, TouchableOpacity, Linking } from 'react-native';
import tw from '../../tailwindApp';
import { useDetalle } from '../hooks/useDetalle';

const WEB_URL = 'https://marketflowpelonesdev-production.up.railway.app/productos';

export default function DetalleScreen({ route, navigation }) {
  const { id } = route.params;
  const { producto, loading, error } = useDetalle(id);

  if (loading) return <ActivityIndicator size="large" style={tw`mt-10`} />;
  if (error) return <Text style={tw`text-red-500 text-center mt-10`}>{error}</Text>;

  return (
    <FlatList
      data={producto.comentarios}
      keyExtractor={item => String(item.id)}
      ListHeaderComponent={
        <View style={tw`bg-white`}>

          {/* Botón regresar */}
          <TouchableOpacity
            onPress={() => navigation.goBack()}
            style={tw`p-4`}
          >
            <Text style={tw`text-brand-blue-200 font-bold text-base`}>← Regresar</Text>
          </TouchableOpacity>

          {/* Imagen */}
          <Image
            source={{ uri: producto.imagen }}
            style={tw`w-full h-72`}
            resizeMode="cover"
          />

          {/* Info */}
          <View style={tw`p-4`}>
            <Text style={tw`text-gray-400 text-xs`}>STOCK DISPONIBLE: {producto.stock}</Text>
            <Text style={tw`text-2xl font-bold text-main-black mt-1`}>{producto.nombre}</Text>
            <Text style={tw`text-brand-blue-400 font-bold text-2xl mt-1`}>${producto.precio}</Text>
            <Text style={tw`text-gray-500 mt-3`}>{producto.descripcion}</Text>
          </View>

          {/* Botón ver en tienda */}
          <TouchableOpacity
            onPress={() => Linking.openURL(`${WEB_URL}/${id}`)}
            style={tw`mx-4 mb-4 bg-brand-blue-200 py-4 rounded-2xl items-center`}
          >
            <Text style={tw`text-white font-bold text-base`}>🛒 Ver en tienda</Text>
          </TouchableOpacity>

          {/* Título comentarios */}
          <View style={tw`px-4 py-3 border-t border-gray-100`}>
            <Text style={tw`text-lg font-bold text-main-black`}>💬 Opiniones de la comunidad</Text>
          </View>
        </View>
      }
      renderItem={({ item }) => (
        <View style={tw`px-4 py-3 border-b border-gray-100`}>
          <View style={tw`flex-row items-center mb-1`}>
            <View style={tw`w-8 h-8 rounded-full bg-brand-blue-200 items-center justify-center mr-2`}>
              <Text style={tw`text-white font-bold text-xs`}>
                {String(item.id_user).charAt(0).toUpperCase()}
              </Text>
            </View>
            <View>
              <Text style={tw`font-bold text-main-black text-sm`}>{item.usuario}</Text>
              <Text style={tw`text-gray-400 text-xs`}>{item.fecha}</Text>
            </View>
          </View>
          <Text style={tw`text-gray-600 ml-10`}>{item.comentario}</Text>
        </View>
      )}
      ListEmptyComponent={
        <Text style={tw`text-gray-400 text-center py-6`}>Sin comentarios aún</Text>
      }
      contentContainerStyle={tw`pb-10`}
      showsVerticalScrollIndicator={false}
    />
  );
}