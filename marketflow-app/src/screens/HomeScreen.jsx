import React from 'react';
import { SafeAreaView, View, FlatList, TextInput, Text, StatusBar, ActivityIndicator } from 'react-native';
import tw from '../../tailwindApp';
import ProductoCard from '../components/ProductoCard';
import { useProductos } from '../hooks/useProductos';

export default function HomeScreen({ navigation }) {
  const { productos, loading, error, busqueda, setBusqueda } = useProductos();

  return (
    <SafeAreaView style={tw`flex-1 bg-gray-50`}>
      <StatusBar barStyle="light-content" />

      {/* Header */}
      <View style={tw`bg-brand-blue-200 p-6 pb-8 rounded-b-[30px]`}>
        <Text style={tw`text-white text-3xl font-bold tracking-tighter text-center mb-5`}>
          MarketFlow
        </Text>
        <View style={tw`bg-white flex-row items-center px-4 py-3 rounded-2xl shadow-xl`}>
          <Text style={tw`text-brand-blue-200 mr-2 font-bold`}>🔍</Text>
          <TextInput
            placeholder="Explorar catálogo..."
            placeholderTextColor="#A4B7D7"
            style={tw`flex-1 text-main-black font-medium`}
            value={busqueda}
            onChangeText={setBusqueda}
          />
        </View>
      </View>

      {/* Contenido */}
      <View style={tw`flex-1 px-2`}>
        {loading ? (
          <ActivityIndicator size="large" style={tw`mt-10`} />
        ) : error ? (
          <Text style={tw`text-red-500 text-center mt-10`}>{error}</Text>
        ) : (
          <FlatList
            data={productos}
            renderItem={({ item }) => (
              <ProductoCard
                item={item}
                onPress={() => navigation.navigate('Detalle', { id: item.id })}
              />
            )}
            keyExtractor={item => String(item.id)}
            numColumns={2}
            ListHeaderComponent={
              <View style={tw`py-4 px-2`}>
                <Text style={tw`text-brand-blue-400 font-extrabold text-xl`}>Nuestros Productos</Text>
                <Text style={tw`text-gray-400 text-xs`}>
                  {productos.length} producto{productos.length !== 1 ? 's' : ''} encontrado{productos.length !== 1 ? 's' : ''}
                </Text>
              </View>
            }
            ListEmptyComponent={
              <Text style={tw`text-gray-400 text-center mt-10`}>
                No se encontraron productos con "{busqueda}"
              </Text>
            }
            contentContainerStyle={tw`pb-10`}
            showsVerticalScrollIndicator={false}
          />
        )}
      </View>
    </SafeAreaView>
  );
}